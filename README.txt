/**
 * @package    Kohana/Gerador
 * @category   Base
 * @author     Paulo Knob
 * @copyright  (c) 2014 Paulo Knob
 */

HOW TO USE:

1) Copy the Gerador module to your Modules directory.

2) Find the Kohana::modules array in your Bootstrap file. Add the line: 'gerador' => MODPATH.'gerador',      // Gerador

3) To instance a new Gerador, use:

	$view->gerador = Gerador::factory(array(
            'urlForm' => 'url/to/post/form',
            'urlUpload' => 'url/to/generate/files/'
         ));

  and, in the View, just show:

	echo $gerador;

  where: 'url/to/post/form' is the path to your method, where you will send the post fields to Gerador, this way:

        public function yourMethod() {
            $gerador = Gerador::factory(array(
                'urlForm' => 'url/to/post/form',
                'urlUpload' => 'url/to/generate/files/'
                ));
            
	    //CREATE THE FILES
            $gerador->salvar($this->request->post());
        }

IMPORTANT THINGS:

- This project includes some scripts and images, in the "extras" folder. You can use your own scripts and images, just changing the paths on the gerador/views/gerador/basic.php. Otherwise, copy the "extras" folder to your project root folder.

- The code generates a directory in your 'urlUpload' folder (which needs to have writing permission), with the module´s name. Within it, it generates other 4 directories (controller, messages, model and view), with their respective files. I have found some small issues on the ORM Module, so i had it changed and added to this project. Feel free to use it.

- Guess is it. Some other answers you can find on the "Instructions" of the Gerador, or in the code comments.

Enjoy It!