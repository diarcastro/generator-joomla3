'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  yosay = require('yosay'),
  s = require('underscore.string'),
  pluralize = require('pluralize'),
  path = require('path');


var toExport = generators.Base.extend({
  constructor: function() {
    generators.Base.apply(this, arguments);
    this.s = s;
    this.pluralize=pluralize;
  },
  firstMethod:function(){
    this.log(yosay('Sorry, this section is under construction, please come back later!'));
  }
});

module.exports = toExport;
