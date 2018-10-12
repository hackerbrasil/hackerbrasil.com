(function() {
  (function($) {
    "use strict";
    /*
    Defaults
    */

    var ProgressBar, defaults, old;
    defaults = {
      isRemoveOnComplete: true,
      className: "waiting",
      id: "progress",
      height: "2px",
      backgroundColor: "#b91f1f",
      progress: 0
    };
    /*
    Class
    */

    ProgressBar = (function() {
      function ProgressBar(el, options) {
        this.el = el;
        this.options = options;
        this.$el = $(this.el);
        this.initialize();
      }

      ProgressBar.prototype.initialize = function() {
        this.div = this.createElement();
        return this.render();
      };

      ProgressBar.prototype.render = function() {
        return this.$el.append(this.div);
      };

      ProgressBar.prototype.createElement = function() {
        var backgroundColor, className, dd, div, dt, height, id, progress;
        id = this.options.id;
        className = this.options.className;
        progress = this.options.progress;
        height = this.options.height;
        backgroundColor = this.options.backgroundColor;
        div = document.createElement('div');
        dt = document.createElement('dt');
        dd = document.createElement('dd');
        div = $(div);
        div.attr({
          id: id,
          "class": className
        });
        div.css({
          backgroundColor: backgroundColor,
          height: height,
          width: "" + progress + "%"
        });
        div.append(dt);
        div.append(dd);
        return div;
      };

      ProgressBar.prototype.updateProgress = function(value, callback) {
        var isRemoveOnComplete;
        if (callback == null) {
          callback = function() {};
        }
        isRemoveOnComplete = this.options.isRemoveOnComplete;
        this.div.css({
          width: "" + value + "%"
        });
        if (value === 100 && isRemoveOnComplete) {
          return this.destroy(callback);
        }
      };

      ProgressBar.prototype.destroy = function(callback) {
        var _this = this;
        return setTimeout(function() {
          _this.div.attr({
            "class": "done"
          });
          return setTimeout(function() {
            _this.div.remove();
            return callback();
          }, 500);
        }, 1000);
      };

      return ProgressBar;

    })();
    /**
    PROGRESSBAR PLUGIN DEFINITION
    */

    old = $.fn.progressbar;
    $.fn.progressbar = function(options) {
      return this.each(function() {
        /*
        Initialize
        */

        var _this = this;
        if (!this.progressbar) {
          options = $.extend({}, defaults, options);
          this.progressbar = new ProgressBar(this, options);
        }
        /*
        Options is number
        */

        if (options && typeof options === "number") {
          this.progressbar.updateProgress(options, function() {
            _this.progressbar = null;
            return _this.progressbar = void 0;
          });
        }
        /*
        Options is object
        */

        if (options && typeof options === "object") {
          $.extend(this.progressbar.options, options);
          if (options.progress) {
            return this.progressbar.updateProgress(options.progress);
          }
        }
      });
    };
    $.fn.progressbar.Constructor = ProgressBar;
    /**
    PROGRESSBAR NO CONFLICT
    */

    return $.fn.progressbar.noConflict = function() {
      $.fn.progressbar = old;
      return this;
    };
  })(jQuery);

}).call(this);
