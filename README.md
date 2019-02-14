# www.theAlcoveGroup.com
Development source and WordPress build for www.alcoveglobal.com.

Source sass and flat/static HTML lives in `flat-front/`. Built using Foundation. [See docs.](flat-front)

Wordpress core and plugins (as well as uploads) live in `wordpress/` directory.

**Important note:**

When sass is watched/compiled from the source folder, it builds to the theme in the wordpress folder, which is intentional. However, the styles for the microsite:

`flat-front/scss/microsite.scss`

will compile to the parent theme and not the proper microsite theme. For now it needs to be moved manually from:

`wordpress/wp-content/themes/thealcovegroup/stylesheets`

to:

`wordpress/wp-content/themes/thealcovegroup-microsite/stylesheets`
