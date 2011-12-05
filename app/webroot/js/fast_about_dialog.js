if ( !CKEDITOR.dialog.exists( 'myDialog' ) ) {
    var href = document.location.href.split( '/' );
    href.pop();
    href.push( 'api_dialog', 'my_dialog.js' );
    href = href.join( '/' );
    var elements = [
        {
            id: 'width',
            type: 'text',
            label: 'Ширина: '
        },
        {
            id: 'height',
            type: 'text',
            label: 'Высота: '
        },
        {
            id: 'glubina',
            type: 'text',
            label: 'Глубина: '
        },
        {
            id: 'thickness',
            type: 'text',
            label: 'Толщина: '
        },
        {
            id: 'length',
            type: 'text',
            label: 'Длина: '
        },
        {
            id: 'size',
            type: 'text',
            label: 'Размер: '
        },
        {
            id: 'diameter',
            type: 'text',
            label: 'Диаметр: '
        },
        {
            id: 'extent',
            type: 'text',
            label: 'Объем: '
        },
        {
            id: 'material',
            type: 'text',
            label: 'Материал: '
        },
        {
            id: 'amount',
            type: 'text',
            label: 'Кол-во в коробке: '
        },
        {
            id: 'color',
            type: 'text',
            label: 'Цвет: '
        },
        {
            id: 'note',
            type: 'text',
            label: 'Примечание: '
        }
    ];
    CKEDITOR.dialog.add( 'DlgFastNote', function(editor) {
        return {
            title : 'Быстрый ввод описания',
            minWidth : 400,
            //minHeight : 200,
            height: 100,
            resizable: CKEDITOR.DIALOG_RESIZE_BOTH,
            onOk: function() {
                var all_text = '<ul class="list-data">';
                for(key in elements) {
                    var element = elements[key];
                    console.log(element);
                    var text = this.getContentElement('fast_about', element.id).getInputElement().getValue();
                    console.log(text);
                    if(text != '')
                        all_text += '<li>' + element.label + text + '</li>';
                }
                all_text += '</ul>';
                this._.editor.insertHtml(all_text);
            },
            contents : [{
                    id : 'fast_about',
                    label : 'First Tab',
                    title : 'First Tab',
                    elements : elements
                }]
        };
    } );
}

CKEDITOR.on('instanceCreated', function(e) {
    var editor = e.editor;
    editor.on( 'pluginsLoaded', function( ev ) {
        editor.addCommand( 'CmdFastNote', new CKEDITOR.dialogCommand( 'DlgFastNote' ) );
        editor.ui.addButton( 'BtnFastNote',
        {
            label : 'Быстрый ввод описания',
            command : 'CmdFastNote',
            icon: '../../img/fast_note.png'
        } );
    });
});