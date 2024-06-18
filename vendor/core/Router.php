<?

namespace vendor\core;

class Router
{

    public static $routes = [];
    //Свойство routes - массив, в котором содержится массив наших маршрутов, таблица маршрутов
    public static $route = [];
    //rote - в нем содержится только один текущий маршрут, который вызывается по текущему url адресу

    public static function add($reqexp, $route = [])
    {
        self::$routes[$reqexp] = $route;
    }
    public static function getRoutes()
    {
        return self::$routes;
    }
    public static function getRoute()
    {
        return self::$route;
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //Перенаправляет URl по корректному маршруту
    //Принимает строку $url входящий URL
    //Ничего не возращает

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'];
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
                } else {
                    echo "Метод <b>$controller::$action</b> не найден";
                }
            } else {
                echo "Контроллер <b>$controller</b> не найден";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if($url){
            $params = explode('&', $url, 2);
            if(false===strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }
        return $url;
    }
}
