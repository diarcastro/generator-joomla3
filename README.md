# generator-joomla3 (Yeoomla)
[![NPM version][npm-image]][npm-url]
[![NPM downloads][downloads-image]][downloads-url]

[Joomla 3](http://joomla.org/) resources generator. Created with [Yeoman](http://yeoman.io/)

![Yeoomla](http://i.imgur.com/0z4xLYp.png?1 "Yeoomla")

## What It Does (Better)
Using this generator, you can make quickly a **[Joomla 3](http://joomla.org)** **Components**, **Modules** and **Plugins** skeleton using MVC design pattern and coding standards. These include:


* Generate Components, Modules, Templates and Plugins to install without errors and save you time
* Access Control Lists(ACL)
* Gererate a Internationalization language files
* CamelCase variable notation and files names
* Proper MVC architecture
* PHPDocumentor stubs for every method, as well as page-level doc blocks
* Uses ``'`` over ``"``, because that's what the official Joomla library uses
* All configuration files
* Gulp files and and some suggested dependencies
* Composer config file in components
* Sass and some mixin to use
* Bower file

## Install first
First install yeoman:
```
$ npm install -g yo
```

After install yeoman, install a joomla3 generator:

```
$ npm install -g generator-joomla3
```

Finally, initiate the generator and generate your first **joomla 3.5** component:

```
$ yo joomla3
```

## Subgenerators
There are currently **9** subgenerator:

- *crud*: ``yo joomla3:crud`` Generate a CRUD(Controllers, Models(Form, Filter), Tables, Views, Language, etc.) for a joomla component.

- *module*: ``yo joomla3:module`` Genearte a module with params

- *template*: ``yo joomla3:template`` Genearte a basic template (NEW)

- *plugin*: ``yo joomla3:plugin`` Genearte a plugin(Any type) with params and events.

- *custom-field*: ``yo joomla3:custom-field`` Genearte a custom field (JFormFieldList).

- *controller*: ``yo joomla3:controller`` Generate a JController(Form or Admin) in the current Folder

- *model*: ``yo joomla3:model`` Generate a JModel(Form or List) in the current Folder

- *table*: ``yo joomla3:table`` Generate a JTable in the current Folder

- *rule*: ``yo joomla3:rule`` Generate a JRule field

## Under Construction

## Future improvements
 - Send me yours opinions and possible improvements
[**@diarcastro**](https://twitter.com/diarcastro)
on twitter. Don't forget star the project on [Github](https://github.com/diarcastro/generator-joomla3)


### Tips:
  - Try to run ``yo joomla3:crud`` subgenerator inside the folder created by ``yo joomla3`` before install.
  - Try to create crud(``yo joomla3:crud``) for your tables before install component, if not possible you can run the generators inside the back|front end folder anyway :)
  - Make the model form fields based in your table sql structure
  - Accept overwrite lang files to create all translations correctly

## Releases
``v0.4``
- Added new templates generator by Gonzalo [**@goexrois**](https://twitter.com/goexrois)

``v0.3.7``
- Bug fixed for spanish language in module maker

``v0.3.6``
- Bug fixed in Model form.xml

``v0.3.5``
- Added: JController generator ``yo joomla3:controller`` Try it!
- Added: JModel generator ``yo joomla3:model`` Try it!
- Added: JTable generator ``yo joomla3:table`` Try it!
- Added: JRule generator ``yo joomla3:rule`` Try it!
- Added: rules folder in default generator
- Added: addrulepath attribute in models forms

``v0.3.2``
- Added: custom-field generator ``yo joomla3:custom-field`` Try it!

``v0.3.0``
- Added: plugin generator ``yo joomla3:plugin`` Try it!
- Bug fixed

``v0.2.1``
- Change module generator structure
- Bug fixed

``v0.2.0``
- Added: module generator ``yo joomla3:module`` Try it!
- Added: reusable default data system
- Added: reusable write files
- Bugs fixed and clean code

``v0.1.3``
- Version Checker
- Added: constant for view details
- Added: path in filter.xml

``v0.1.2`` && ``v0.1.1``
- Some bugs fixed

``v0.1.0``
- generator-joomla3 Born

## Donate for improvements and maintenance
[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=VYEPJKUE4469A&lc=US&item_name=generator%2djoomla3&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted)

### License
[MIT License](http://en.wikipedia.org/wiki/MIT_License)

### References:
- [nodejs.org](https://nodejs.org)
- [npmjs.org](https://www.npmjs.com/)
- [yeoman.io](http://yeoman.io/)
- [joomla.org](https://www.joomla.org/)


[npm-image]: https://img.shields.io/npm/v/generator-joomla3.svg?style=flat
[npm-url]: https://npmjs.org/package/generator-joomla3
[downloads-image]: https://img.shields.io/npm/dm/generator-joomla3.svg?style=flat
[downloads-url]: https://npmjs.org/package/generator-joomla3
