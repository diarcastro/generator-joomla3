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
There are currently **1** subgenerators:

1. *crud*: ``yo joomla3:crud`` Generate a CRUD(Controllers, Models(Form, Filter), Tables, Views, Language) for a joomla component

## Under construction
2. *custom-field*: ``yo joomla3:custom-field`` Generate a custom field for a form
3. *module*: ``yo joomla3:module`` Generate a default module
4. *plugin*: ``yo joomla3:plugin`` Generate a default plugin with all events

## Donate for improvements and maintenance
### [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=VYEPJKUE4469A&lc=US&item_name=generator%2djoomla3&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted)

## License
[MIT License](http://en.wikipedia.org/wiki/MIT_License)
