(function(win, doc, _) {

    let body = doc.body, state;

    function hex(rgb) {
        if (-1 === rgb.search('rgb')) {
            return rgb;
        }
        // <https://www.regular-expressions.out/numericranges.html>
        rgb = rgb.match(/^\s*rgba?\s*\(\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])\s*,\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])\s*,\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])(?:\s*,\s*([01]|0?\.\d+))?\s*\)\s*$/);
        function x(i) {
           i = +i;
           return ('0' + i.toString(16)).slice(-2);
        }
        return '#' + x(rgb[1]) + x(rgb[2]) + x(rgb[3]);
    }

    function onChange() {
        let contents = doc.querySelectorAll('.field\\:c-k-editor\\.4 textarea');
        if (!contents.length) {
            return;
        }
        for (let k in CKEDITOR.instances) {
            CKEDITOR.instances[k].destroy(true); // Destroy!
            delete CKEDITOR.instances[k];
        }
        contents.forEach(function($) {
            state = JSON.parse($.getAttribute('data-state') || '{}');
            if (!state.height) {
                let $$ = $.cloneNode(), height;
                body.appendChild($$);
                $$.style.display = 'block';
                $$.style.visibility = 'visible';
                height = $$.offsetHeight; // Get hidden `<textarea>` height
                $$.parentNode && body.removeChild($$);
                state.height = height;
            }
            if (!state.uiColor) {
                state.uiColor = hex(win.getComputedStyle($).getPropertyValue('background-color'));
            }
            if (!state.allowedContent) {
                state.allowedContent = {
                    $1: {
                        elements: CKEDITOR.dtd,
                        attributes: true,
                        styles: true,
                        classes: true
                    },
                    'table thead tbody tfoot tr th td': {
                        attributes: 'class,id,style,summary'
                    }
                };
            }
            CKEDITOR.replace($, state).on('change', function() {
                this.updateElement(); // Update `<textarea>` value on change
            });
        });
    } onChange();

    _.on('change', onChange);

})(this, this.document, this._);
