# phpiggy
 php app for tracking expenses

Notes about filestructure of project:
1) Application class managing all framework tools: router, validator, database, template engine, container.
2) "src" folder containing only code related to application. There is no files for configuring the server.
Folder names(which startes with uppercase symbol) reflect namespace.
3) "src/App/boostrap.php" responsible for loading and configuring the project files necessarily for application.
4) "public/index.php" responsible for initilazing the application.
5) "src/App/functions.php" - file for sugar functions.
6) "src/App/HomeController.php" - responsible for rendering home page at "src/App/view/index.php".
7) "src/Framework/Router.php" - class Router responsible for register and dispatching routes.
8) "src/Framework/Container.php - store a list of instuctions for creating instances.

To-do:
1) add dynamic routing - done.
2) creating template engine - done.
3) added singleton pattern(at container.php), factory design pattern.

Added from me:
1) Routes.php - reworked. In original repo uses "function registerRoutes(App $app)", I use static method of class Routes.