<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Facebook PHP SDK v5 for CodeIgniter 3.x
 *
 * Library for Facebook PHP SDK v5. It helps the user to login with their Facebook account
 * in CodeIgniter application.
 *
 * This library requires the Facebook PHP SDK v5 and it should be placed in libraries folder.
 *
 * It also requires facebook configuration file and it should be placed in the config directory.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      CodexWorld
 * @license     http://www.codexworld.com/license/
 * @link        http://www.codexworld.com
 * @version     2.0
 */

// Include the autoloader provided in the SDK
require_once 'facebook-php-sdk/autoload.php'; 

use Facebook\Facebook as FB;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Helpers\FacebookJavaScriptHelper;
use Facebook\Helpers\FacebookRedirectLoginHelper;
Class Facebook
{
    /**
     * @var FB
     */
    private $fb;
    /**
     * @var FacebookRedirectLoginHelper|FacebookJavaScriptHelper
     */
    private $helper;

    /**
     * Facebook constructor.
     */
    public function __construct(){
        // Load fb config
        $this->load->config('facebook');
        // Load required libraries and helpers
        $this->load->library('session');
        $this->load->helper('url');
        if (!isset($this->fb)){
            $this->fb = new FB([
                'app_id'                => $this->config->item('facebook_app_id'),
                'app_secret'            => $this->config->item('facebook_app_secret'),
                'default_graph_version' => $this->config->item('facebook_graph_version')
            ]);
        }
        // Load correct helper depending on login type
        // set in the config file
        switch ($this->config->item('facebook_login_type')){
            case 'js':
                $this->helper = $this->fb->getJavaScriptHelper();
                break;
            case 'canvas':
                $this->helper = $this->fb->getCanvasHelper();
                break;
            case 'page_tab':
                $this->helper = $this->fb->getPageTabHelper();
                break;
            case 'web':
                $this->helper = $this->fb->getRedirectLoginHelper();
                break;
        }
        if ($this->config->item('facebook_auth_on_load') === TRUE){
            // Try and authenticate the user right away (get valid access token)
            $this->authenticate();
        }
    }
    
    /**
     * @return FB
     */
    public function object(){
        return $this->fb;
    }
    
    /**
     * Check whether the user is logged in.
     * by access token
     *
     * @return mixed|boolean
     */
    public function is_authenticated(){
        $access_token = $this->authenticate();
        if(isset($access_token)){
            return $access_token;
        }
        return false;
    }
    
    /**
     * Do Graph request
     *
     * @param       $method
     * @param       $endpoint
     * @param array $params
     * @param null  $access_token
     *
     * @return array
     */
    public function request($method, $endpoint, $params = [], $access_token = null){
        try{
            $response = $this->fb->{strtolower($method)}($endpoint, $params, $access_token);
            return $response->getDecodedBody();
        }catch(FacebookResponseException $e){
            return $this->logError($e->getCode(), $e->getMessage());
        }catch (FacebookSDKException $e){
            return $this->logError($e->getCode(), $e->getMessage());
        }
    }
    
    /**
     * Generate Facebook login url for web
     *
     * @return  string
     */
    public function login_url(){
        // Login type must be web, else return empty string
        if($this->config->item('facebook_login_type') != 'web'){
            return '';
        }
        // Get login url
        return $this->helper->getLoginUrl(
            base_url() . $this->config->item('facebook_login_redirect_url'),
            $this->config->item('facebook_permissions')
        );
    }
    
    /**
     * Generate Facebook logout url for web
     *
     * @return string
     */
    public function logout_url(){
        // Login type must be web, else return empty string
        if($this->config->item('facebook_login_type') != 'web'){
            return '';
        }
        // Get logout url
        return $this->helper->getLogoutUrl(
            $this->get_access_token(),
            base_url() . $this->config->item('facebook_logout_redirect_url')
        );
    }
    
    /**
     * Destroy local Facebook session
     */
    public function destroy_session(){
        $this->session->unset_userdata('fb_access_token');
    }
    
    /**
     * Get a new access token from Facebook
     *
     * @return array|AccessToken|null|object|void
     */
    private function authenticate(){
        $access_token = $this->get_access_token();
        if($access_token && $this->get_expire_time() > (time() + 30) || $access_token && !$this->get_expire_time()){
            $this->fb->setDefaultAccessToken($access_token);
            return $access_token;
        }
        // If we did not have a stored access token or if it has expired, try get a new access token
        if(!$access_token){
            try{
                $access_token = $this->helper->getAccessToken();
            }catch (FacebookSDKException $e){
                $this->logError($e->getCode(), $e->getMessage());
                return null;
            }
            // If we got a session we need to exchange it for a long lived session.
            if(isset($access_token)){
                $access_token = $this->long_lived_token($access_token);
                $this->set_expire_time($access_token->getExpiresAt());
                $this->set_access_token($access_token);
                $this->fb->setDefaultAccessToken($access_token);
                return $access_token;
            }
        }
        // Collect errors if any when using web redirect based login
        if($this->config->item('facebook_login_type') === 'web'){
            if($this->helper->getError()){
                // Collect error data
                $error = array(
                    'error'             => $this->helper->getError(),
                    'error_code'        => $this->helper->getErrorCode(),
                    'error_reason'      => $this->helper->getErrorReason(),
                    'error_description' => $this->helper->getErrorDescription()
                );
                return $error;
            }
        }
        return $access_token;
    }
    
    /**
     * Exchange short lived token for a long lived token
     *
     * @param AccessToken $access_token
     *
     * @return AccessToken|null
     */
    private function long_lived_token(AccessToken $access_token){
        if(!$access_token->isLongLived()){
            $oauth2_client = $this->fb->getOAuth2Client();
            try{
                return $oauth2_client->getLongLivedAccessToken($access_token);
            }catch (FacebookSDKException $e){
                $this->logError($e->getCode(), $e->getMessage());
                return null;
            }
        }
        return $access_token;
    }
    
    /**
     * Get stored access token
     *
     * @return mixed
     */
    private function get_access_token(){
        return $this->session->userdata('fb_access_token');
    }
    
    /**
     * Store access token
     *
     * @param AccessToken $access_token
     */
    private function set_access_token(AccessToken $access_token){
        $this->session->set_userdata('fb_access_token', $access_token->getValue());
    }
    
    /**
     * @return mixed
     */
    private function get_expire_time(){
        return $this->session->userdata('fb_expire');
    }
    
    /**
     * @param DateTime $time
     */
    private function set_expire_time(DateTime $time = null){
        if ($time) {
            $this->session->set_userdata('fb_expire', $time->getTimestamp());
        }
    }
    
    /**
     * @param $code
     * @param $message
     *
     * @return array
     */
    private function logError($code, $message){
        log_message('error', '[FACEBOOK PHP SDK] code: ' . $code.' | message: '.$message);
        return ['error' => $code, 'message' => $message];
    }
    
    /**
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * @param $var
     *
     * @return mixed
     */
    public function __get($var){
        return get_instance()->$var;
    }
}