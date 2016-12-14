Okay, so let me get started. Do not use this as-is. I originally wrote this a few years back, and decided to clean up the code. I have removed lots of methods, and added namespaces. 

I plan on bringing this back, so will edit it the source and fixing parts, do not fork yet unless you're helping with development. Once it's at a good stage of development, then you can fork, but at the moment, it's not functioning fully yet. 

I will upload the SQL in the future (again) when it's done. Some methods are bloated, that's because I haven't got around to them, some queries don't have transactions; I plan on adding them, and fixing the withdraw part (check user's trade history, make sure it adds up)

Give me ideas regarding storage, cold/hot/luke warm. Anyway, if you would like to help with developement, for from developement branch, never to the main one.


For controllers you add namespaces like so:

	<?php
	namespace Filtration\Controller;

	Class MyController extends \Bdown\Core\Controller
	{

	}


 For models you do:
 
	<?php 
	namespace Filtration\Model;

	Class MyModel
	{
		public static function mymethod(){
			return 123;
		}
	}


To access your model in your controller, use the `use` function:

	<?php
	namespace Filtration\Controller;

	use Bdown\Model\MyModel;
	
	Class MyController extends \Filtration\Core\Controller
	{
		public function index(){
			// access it here
			return MyModel::mymethod();
		}
	}
	




#Installation#

Use composer and Cd to your folder, and run: composer update
