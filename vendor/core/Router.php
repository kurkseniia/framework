<?

class Router {

    // public function __construct()
    // {
    //     echo "Привет";
    // }

    public static $routes=[];
    //Свойство routes - массив, в котором содержится массив наших маршрутов, таблица маршрутов
    public static $route=[];
    //rote - в нем содержится только один текущий маршрут, который вызывается по текущему url адресу

    public static function add($reqexp, $route=[]){
        self::$routes[$reqexp] = $route;
    }
    public static function getRoutes(){
        return self::$routes;
    }
    public static function getRoute(){
        return self::$route;
    }

    public static function matchRoute($url){
        foreach (self::$routes as $pattern=>$route){
            if($url == $pattern){
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
}