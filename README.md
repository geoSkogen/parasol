#### Include the shortcode [parasol_template] on a page to view the test pattern, and get started with your customization.

#### [parasol_template] acepts one stylesheet-path-slug argument, and any number of comma-separated script-path-slug arguments.

#### Consider this example:

#### [parasol_template style_slug='special' script_slugs='hello,main']

#### For the above, only the following resources would be enqueued, no matter how many were registered:

  - style/parasol_special_templater_style.css
  - lib/parasol_hello_templater_script.js
  - lib/parasol_main_templater_script.js

#### This allows us to keep unneeded resources off the page and optimize load time.
#### Keep in mind the added file slugs must be passed as arguments to the Templater object when instantiated in order for WordPress to register them.
#### Two generic file slugs are included by default: parasol_templater_script & parasol_templater_style.
#### For the above example, we would update the frontend object definition on lines 32-35 of parasol.php:

- `$frontend = new Parasol_Templater(
     ['parasol_templater_script','parasol_hello_templater_script','parasol_main_templater_script'],
     ['parasol_templater_style','parasol_special_templater_style']
     );`

#### The generic templater stylesheet and script will both be enqueued by default if no text attributes are included in the shortcode.

#### To include the generic script or stylesheet along with the custom list, insert an extra comma into the comma-separated attributes to denote an empty string, e.g.:

- script_slugs='hello,main,'  -or-
- script_slugs=',hello,main'  -or-
- script_slugs='hello,,main'
