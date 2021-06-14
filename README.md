# GPDR-Compliance

GDPRCookieMaker is not autmatically makes your site GDRP-compliant. Please seek independent legal adivce since GPDR is a very unique topic for each website.

## CODING STANDARDS

The plugin is coded with **Modern PHP** and **WordPress Coding Standards**. It’s purely based on OOP coding techniques. It’s highly extendable for developers with several action and filter hooks.
GDPRCookieMaker keep your store performance in mind. Every script is **loaded conditionally** and all input and output data is secured.

## Installation

Following are the 2 ways for plugin installation:

### Direct Upload Folder

GDPRCookieMaker Plugin for WordPress is simple to install:

1. Download the .zip'
2. Unzip
3. Upload  the directory to your '/wp-content/plugins' directory
4. Go to the plugin management page and enable the GDPRCookieMaker WordPress Plugin
5. Browse to Settings > GDPRCookieMaker
6. Customise your content, design and script settings.

### Composer

This plugin is a composer package so it can be install using the `composer require` command in the `composer.json` file.

```

"require": {
        "fossmentorofficial/fm-cookie-popup-wp": "^1.0.1"
    }

``` 

My plugin is only available on GITHUB server. So, must need to provide the Git repository url as well.

```

"repositories": [
	{
		"type": "vcs",
		"url": "git@github.com:fossmentorofficial/fm-cookie-popup-wp.git"
	}
]

```

After the successful installation, this plugin will show under the `plugins` directory.


## License and Copyright

Copyright (c) 2021 FOSSMentorOfficial

This plugin code is licensed under [GNU GPI v2.0](./LICENSE).

The developer is engineering the Web since 2010