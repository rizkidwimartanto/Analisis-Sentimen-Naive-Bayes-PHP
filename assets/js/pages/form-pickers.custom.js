! function(a) {
    "use strict";
    var t = function() {};
    t.prototype.init = function() {
        $('#reportrange').daterangepicker(
		{format:"MM/DD/YYYY",locale: {format: 'YYYY-MM-DD'}},
		function(start, end, label) {
			$('#reportrange').val(start.format('YYYY-MM-DD')+'-'+end.format('YYYY-MM-DD'));
		});
    }, a.FormPickers = new t, a.FormPickers.Constructor = t
}(window.jQuery),
function(t) {
    "use strict";
    window.jQuery.FormPickers.init()
}();