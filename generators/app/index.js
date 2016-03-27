'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  yosay = require('yosay'),
  s = require('underscore.string'),
  pluralize = require('pluralize'),
  path = require('path');


var joomla3 = generators.Base.extend({
  constructor: function() {
    generators.Base.apply(this, arguments);
    this.s = s;
    this.pluralize=pluralize;

  },
  askForProjectName:function(){
    this.log(yosay('Hello! Welcome to Joomla 3.5 generator by Diego Castro @diarcastro'));
    var prompts = [{
      type: 'text',
      name: 'projectName',
      message: 'Please type a component name(without \'com_\'): ',
      default: s(s.slugify(this.appname)).toLowerCase().value(),
      validate: function(input) {
        return input !== '' && !input.match(/^(com_)/);
      }
    }];
    var done = this.async();
    return this.prompt(prompts, (function(answers) {
      this.projectName = this.s(this.s.slugify(answers.projectName)).toLowerCase().value();
      done();
    }).bind(this));
  },
  askForProjectData: function() {
    var prompts = [{
      type: 'text',
      name: 'projectDescription',
      message: 'Please type a project Description: ',
      default: 'No Description'

    },{
      type: 'text',
      name: 'authorName',
      message: 'Please type the author name: ',
      default: 'Diego Castro'
    }, {
      type: 'text',
      name: 'authorEmail',
      message: 'Please type the author email: ',
      default: 'ing.diegocastro@gmail.com'
    }, {
      type: 'text',
      name: 'authorURL',
      message: 'Please type the author url: ',
      default: ''
    }, {
      type: 'text',
      name: "license",
      message: "What's the copyright license?",
      default: "MIT"
    }, {
      type: 'text',
      name: "defaultView",
      message: "What's the default component view?",
      default: pluralize(this.projectName),
      validate: function(input) {
        return input !== '';
      }
    },{
      type:'text',
      name:'submenu',
      message:'Type the submenus separates by comma(,)',
      default:pluralize(this.projectName)
    }
  ];
    var done = this.async();
    return this.prompt(prompts, (function(answers) {
      this.currentDate = new Date();

      this.projectType = 'component';
      this.structureType = require('../includes/' + this.projectType + '.structure');
      this.projectDescription = answers.projectDescription;
      this.componentName = 'com_' + this.projectName;
      this.defaultView = s.slugify(answers.defaultView);

      this.creationDate = this.currentDate.getFullYear() + '-' + (this.currentDate.getMonth() + 1) + '-' + this.currentDate.getDate();
      this.authorName = answers.authorName;
      this.authorEmail = answers.authorEmail;
      this.authorURL = answers.authorURL;
      this.license = answers.license;
      var submenu=[],
      submenuArr=answers.submenu.split(',');
      for(var i=0;i<submenuArr.length;i++){
        var cleaned=s.slugify(s.clean(submenuArr[i]));
        if(cleaned){
          submenu.push(cleaned);
        }
      }
      this.submenu=submenu;
      done();
    }).bind(this));
  },
  makeApp: function() {
    this._makeFolders();
  },
  _makeFolders: function() {
    var envs = this.structureType(this.projectName);
    if (envs) {
      for (var env in envs) {
        var files = envs[env];
        for (var file in files) {
          if (this.fs.exists(this.templatePath(file))) {
            var realFile = files[file] ? files[file] : file;
            this.fs.copyTpl(
              this.templatePath(file),
              this.componentName + '/' + realFile,
              this
            );
          } else {
            this.fs.copyTpl(
              this.templatePath('index.html'),
              this.componentName + '/' + file + '/index.html',
              this
            );
          }
        }
      }

    }
  },
  /**
   * Returns the values of an objects, like associative arrays.
   *
   * @param obj The object to parse.
   * @returns {Array} The list of the values.
   * @private
   */
  _getObjectValues: function(obj) {
    var values = [];
    for (var key in obj) {
      if (obj.hasOwnProperty(key)) {
        values.push(obj[key]);
      }
    }

    return values;
  },
  _getKeyByValue: function(value, object) {
    for (var prop in object) {
      if (object.hasOwnProperty(prop)) {
        if (object[prop] === value) {
          return prop;
        }
      }
    }
  }
});

module.exports = joomla3;
