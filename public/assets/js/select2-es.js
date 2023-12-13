$.fn.select2.amd.define('select2/i18n/es',[],function () {
    return {
        errorLoading: function () {
            return 'No se pudieron cargar los resultados';
        },
        inputTooLong: function (args) {
            var overChars = args.input.length - args.maximum;
            var message = 'Por favor, elimine ' + overChars + ' caracter';
            if (overChars != 1) {
                message += 'es';
            }
            return message;
        },
        inputTooShort: function (args) {
            var remainingChars = args.minimum - args.input.length;
            var message = 'Por favor, introduzca ' + remainingChars + ' o más caracteres';
            return message;
        },
        loadingMore: function () {
            return 'Cargando más resultados…';
        },
        maximumSelected: function (args) {
            var message = 'Sólo puede seleccionar ' + args.maximum + ' elemento';
            if (args.maximum != 1) {
                message += 's';
            }
            return message;
        },
        noResults: function () {
            return 'No se encontraron resultados';
        },
        searching: function () {
            return 'Buscando…';
        },
    };
});

$(document).ready(function() {
    $.extend(true, $.fn.select2.defaults, {
        language: 'es'
    });
});
