var extend = require('extend'),
  s = require('underscore.string'),
  yg = null,
  writeFiles = {
    assignYo: function(yeomanGenerator) {
      yg = yeomanGenerator;
      return this;
    },
    write: function(data) {
      var structure = require('./' + data.files);
      if (structure) {
        var files = structure(data.projectName);
        for (var file in files) {
          if (yg.fs.exists(yg.templatePath(file))) {
            var realFile = files[file] ? files[file] : file;
            yg.fs.copyTpl(
              yg.templatePath(file),
              data.destination + '/' + realFile,
              yg
            );
          } else {
            yg.fs.copyTpl(
              yg.templatePath('index.html'),
              data.destination + '/' + file + '/index.html',
              yg
            );
          }
        }
      }
    }
  };

module.exports = writeFiles;
