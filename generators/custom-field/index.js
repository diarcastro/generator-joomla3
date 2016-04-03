'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  s = require('underscore.string'),
  updateChecker = require('../includes/update-checker'),
  data={};


var toExport = generators.Base.extend({
  constructor: function() {
    generators.Base.apply(this, arguments);
    this.s = s;
  },
  checkForUpdates:function(){
    updateChecker('Custom fields Generator!');
  },
  askForProjectName:function(){
    var prompts=[
      {
        type:'text',
        name:'projectName',
        message:'Type the Custom field name:',
        required:true
      }
    ];
    var done=this.async();
    return this.prompt(prompts, (function(answers) {
      data.projectName = answers.projectName.slugify();
      done();
    }));
  },
  askForData:function(){
    var prompts=[
      {
        type:'text',
        name:'tableName',
        message:'Type the table name from select data(without #__):',
        default:data.projectName,
        required:true
      },
      {
        type:'text',
        name:'fieldValue',
        message:'Type the field value:',
        default:'id',
        required:true
      },
      {
        type:'text',
        name:'fieldText',
        message:'Type the field text:',
        default:'name',
        required:true
      },
      {
        type:'text',
        name:'customWhere',
        message:'Type custom where clause:'
      },
    ];
    var done=this.async();
    return this.prompt(prompts,function(answers){
      for(var i in answers){
        data[i]=answers[i].slugify();
      }
      data.customWhere=answers.customWhere;
      done();
    });
  },
  writing:function(){
    this.data=data;
    this.fs.copyTpl(
      this.templatePath('custom.php'),
      data.projectName.lCase()+'.php',
      this
    );
  }
});

module.exports = toExport;
