Drupal 8 Ecommerce Module
====

Requirements

	# Enable module
	$ drush en ecommerce
	# Download using drush
	$ drush dl composer_manager
	# Enable composer_manager
	$ drush en -y composer_manager
	# Register composer command for Drupal core
	$ drush composer-manager-init
	$ cd core
	$ composer drupal-update