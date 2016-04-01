# generator-joomla3 (Yeoomla)
[Joomla](http://joomla.org/) 3.5 generator for [Yeoman](http://yeoman.io/)

![Yeoomla](http://i.imgur.com/0z4xLYp.png?1 "Yeoomla")

## What It Does (Better)
Using this generator, you can make quickly a [joomla](http://joomla.org) component(module, plugin, custom field comming soon) skeleton using MVC design pattern and coding standards. These include:


* Gererate a Internationalization language files
* CamelCase variable notation and files names
* Proper MVC architecture
* PHPDocumentor stubs for every method, as well as page-level doc blocks
* Uses ``'`` over ``"``, because that's what the official Joomla library uses
* All configuration files


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
There are currently **2** subgenerator:

1. *crud*: ``yo joomla3:crud`` Generate a CRUD(Controllers, Models(Form, Filter), Tables, Views, Language, etc.) for a joomla component
2. *module*: ``yo joomla3:module`` Genearte a generic module with params

## Under construction
- *custom-field*: ``yo joomla3:custom-field`` Generate a custom field for a form in the current folder
- *plugin*: ``yo joomla3:plugin`` Generate a plugin with all events
- *controller*: ``yo joomla3:controller`` Generate a generic JController(Form or Admin) in the current Folder
- *model*: ``yo joomla3:model`` Generate a generic JModel(Form or List) in the current Folder
- *table*: ``yo joomla3:table`` Generate a generic JTable(Form or List) in the current Folder

## Releases
``v0.2.0``
- Added: module generator ``yo joomla3:module``
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
### [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=VYEPJKUE4469A&lc=US&item_name=generator%2djoomla3&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted)

## License
[MIT License](http://en.wikipedia.org/wiki/MIT_License)
