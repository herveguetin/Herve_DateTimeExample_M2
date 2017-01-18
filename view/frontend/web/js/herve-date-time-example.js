/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Hervé Guétin <herve.guetin@gmail.com> <@herveguetin>
 */
define([
    "jquery",
    "moment",
    "jquery/ui"
], function($, moment) {
    "use strict";

    $.widget('herve.dateTimeExample', {
        _create: function () {
            var jsonConfigFromPhtml = this.options;
            var momentResult = moment(jsonConfigFromPhtml.iso).fromNow();
            this.element.html(momentResult);
        }
    });

    return $.herve.dateTimeExample;
});