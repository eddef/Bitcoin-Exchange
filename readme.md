Okay, so let me get started. Do not use this as-is. I originally wrote this a few years back, and decided to clean up the code. I have removed lots of methods, and added namespaces. 
I have stopped working on this so haven't added all the namespaces in, so you will need to do that yourself.

For controllers you add namespaces like so:

	<?php
	namespace Bdown\Controller;

	Class MyController extends \Bdown\Core\Controller
	{

	}


 For models you do:
 
	<?php 
	namespace Bdown\Model;

	Class MyModel
	{
		public static function mymethod(){
			return 123;
		}
	}


To access your model in your controller, use the `use` function:

	<?php
	namespace Bdown\Controller;

	use Bdown\Model\MyModel;
	
	Class MyController extends \Bdown\Core\Controller
	{
		public function index(){
			// access it here
			return MyModel::mymethod();
		}
	}
	
Now, throughout the code, you will notice bloated methods; the reason for this is because I never got round to putting them inside models and controllers, so you will have to do that yourself
Some methods have also been replaced, so keep an eye out for them, $this->encrypt for example has been removed. This will take some time to get working, but should bypass the starting-blocks
and have a pre-built framework for your bitcoin exchange.


I take no responsibilty for this, I built it a long time a go, it was dwarfed by another project and rushed, hence why I decided to clean it up a little.


#Installation#

Use composer and Cd to your folder, and run: composer update