var amwayCalApp = angular.module("amwayCalApp", ["ngRoute"]).config(["$locationProvider", "$routeProvider", function(e, t) {
    e.hashPrefix("!"), t.when("/country/:country", {
        templateUrl: BaseUrl+"/public/hiten/template/calculator.html",
        controller: "treeController",
        controllerAs: "tree"
    }).otherwise({
        templateUrl: BaseUrl+"/public/hiten/template/calculator.html",
        controller: "treeController",
        controllerAs: "tree"
    })
}]).controller("treeController", ["$scope", "$http", "$log", "$routeParams", "$rootScope", function(e, t, l, o, a) {
    e.params = o, e.port = location.port, t.get(BaseUrl+"/public/hiten/js/bonus-schedules.json").then(function(l) {
        e.allSchedules = l.data, e.scheduleInfo = e.allSchedules[e.params.country], 
		e.allCountry = Object.keys(e.allSchedules).sort(), 
		e.scheduleInfo && (e.scheduleInfo.similarTo && (e.scheduleInfo.schedule = e.allSchedules[e.scheduleInfo.similarTo].schedule), 
		//document.title = e.scheduleInfo.marketName + " Amway", angular.element(document).find("h1.entry-title").html(document.title), n(),
		t.get(BaseUrl+"/v3/member-net-sale-infinity?id="+MemberID).then(function(t) {
            e.tree = t.data, e.calculate()
        }))
    });
    var n = function() {
       /* var t, l = location.origin + "/acalc/imgs/amway-calculator-" + e.params.country + ".jpg";
        l = {
            "head>link[rel='canonical']": ["href", location.href],
            "meta[property='og:url']": ["content", location.href],
            "meta[property='og:title']": ["content", document.title],
            "meta[property='og:image']": ["content", l],
            "meta[name='twitter:title']": ["content", document.title],
            "meta[name='twitter:image']": ["content", l]
        };
        for (t in l) angular.element(document).find(t).attr(l[t][0], l[t][1])*/
    };
    e.calculate = function() {
        l.debug("calculate......"), r(e.tree[0]), c(e.tree[0])
    }, e.gaTreeChanged = function(e) {}, e.populateExampleBv = function(t, l) {
        if (t.children && 0 != t.children.length)
            for (var o in t.children) e.populateExampleBv(t.children[o], l);
        else t.bv = Math.round(t.bv * l)
    };
    var r = function(t) {
            if (t.pv = Math.round(t.bv / e.scheduleInfo.bvPvRatio), t.children && 0 != t.children.length) {
                var l, o = t.bv;
                for (l in t.children) o += r(t.children[l]);
                t.totalBv = o
            } else t.totalBv = t.bv;
            var a;
            t.totalPv = Math.floor(t.totalBv / e.scheduleInfo.bvPvRatio);
            e: {
                for (a in e.scheduleInfo.schedule)
                    if (o = e.scheduleInfo.schedule[a], t.totalBv >= Math.floor(o.pv * e.scheduleInfo.bvPvRatio)) {
                        a = o.rate;
                        break e
                    }
                a = 0
            }
            return t.bonusRate = a, t.totalBv
        },
        c = function(e) {
            if (e.children && 0 != e.children.length) {
                var t, l = e.totalBv * e.bonusRate;
                for (t in e.children) c(e.children[t]), l -= e.children[t].totalBv * e.children[t].bonusRate;
                e.bonus = Math.round(l)
            } else e.bonus = Math.round(e.totalBv * e.bonusRate)
        }
}]).directive("recurv", function() {
    return {
        restrict: "E",
        templateUrl: BaseUrl+"/public/hiten/template/aItem.html",
        scope: {
            tree: "=",
            scheduleInfo: "<",
            calculate: "&",
            gaTreeChanged: "&"
        },
        link: function(e, t, l) {
            e.addNode = function(t) {
                var l = "You" == t.ibo ? "DL" : t.ibo;
                t.children ? t.children.push({
                    bv: 0,
                    ibo: l + "." + (t.children.length + 1)
                }) : t.children = [{
                    bv: 0,
                    ibo: l + ".1"
                }], e.gaTreeChanged({
                    action: "Add New Downline"
                })
            }, e.deleteNode = function(t, l) {
                t.splice(l, 1), e.calculate(), e.gaTreeChanged({
                    action: "Delete IBO"
                })
            }
        }
    }
});