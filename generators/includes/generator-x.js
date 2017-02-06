'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  s = require('underscore.string'),
  updateChecker = require('../includes/update-checker'),
  pluralize = require('pluralize'),
  data={};


var GeneratorX = function(type){
  return generators.Base.extend({
    constructor: function() {
      generators.Base.apply(this, arguments);
      this.s = s;
      this.pluralize = pluralize;
      this.generatorType=type;
      this.paramToPhp=function(data){
        return 'string';
      };
      this.firstStringField=function(){
        return 'id';
      };
    },
    checkForUpdates:function(){
      updateChecker(s.capitalize(this.generatorType)+' Generator!');
    },
    askForProjectName:function(){
      var prompts=[
        {
          type:'text',
          name:'projectName',
          message:'Type the component name:',
          required:true,
          default: this.appname.slugify(),
          validate: function(input) {
            var success = input !== '' && !input.match(/^(com_)/);
            if (!success) {
              console.log('\nThe component name can\'t init with sufix com_.');
            }
            return success;
          }
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
          name:'name',
          message:'Type the '+this.generatorType+' name:',
          default:data.projectName,
          required:true
        }

      ];
      if(this.generatorType!=='table'){
        prompts.push(
          {
            type:'confirm',
            name:'list',
            message:'Is a '+this.generatorType+' list?',
            default:false,
            required:true
          }
        );
      }
      var done=this.async();
      return this.prompt(prompts,function(answers){
        data.name=answers.name.toString().slugify();
        data.list=answers.list?'list':'';
        done();
      });
    },
    writing:function(){
      data.fields=[{name:'id', type:'hidden', reguired:true}];
      data.formFields={published:1, language:1};
      data.componentName='com_'+data.projectName;
      data.modelItemName=data.modelListName=data.name;
      data.names={
        item:{
          controller:s.capitalize(data.projectName)+'Controller'+s.capitalize(data.name),
          model:s.capitalize(data.projectName)+'Model'+s.capitalize(data.name),
          table:s.capitalize(data.projectName)+'Table'+s.capitalize(data.name)
        },
        list:{
          controller:s.capitalize(data.projectName)+'Controller'+s.capitalize(data.name),
          model:s.capitalize(data.projectName)+'Model'+s.capitalize(data.name)
        }
      };
      if(data.list){
        data.modelItemName=pluralize.singular(data.name);
        if(type=='controller'){
          data.names.item.model=pluralize.singular(data.names.item.model);
        }else if(type=='model'){
          data.names.item.table=pluralize.singular(data.names.item.table);
        }
      }
      this.data=data;
      this.fs.copyTpl(
        this.templatePath('../../crud/templates/'+pluralize(this.generatorType)+'/'+this.generatorType+data.list+'.php'),
        data.name+'.php',
        this
      );
    }
  });
};

module.exports = GeneratorX;
