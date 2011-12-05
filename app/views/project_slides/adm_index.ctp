<h1>Изображения проекта "<?php echo $project['Project']['name'];?>"</h1>
<div class="ui-state-default ui-corner-all" style="padding: 5px;">
    <a href="<?php echo $html->url("/projects/adm_index/");?>">
        Список портфолио
    </a>
</div>

<div class="div-warning"> * Внимание: для корректного отображения изображений проекта,
сортировка должна быть выставлена целыми числами от 1 до n, где n - количество изображений в проекте</div>

<div class="div-add-action">
    <a id="link-add-project-slide" href="#" onclick="return false;">Добавить</a>
</div>

<div id="table-header">
    <div class="td-id">Номер</div>
    <div class="td-image">Мал. изобр-е</div>
    <div class="td-image">Бол. изобр-е</div>
    <div class="td-sort-order">Сорт-ка</div>
    <div class="td-action">Действие</div>
</div>

<ul id="table-body">
    <?php foreach($project_slides as $project_slide) {
        $project_slide_id =     $project_slide['ProjectSlide']['id'];
        $sort_order =           $project_slide['ProjectSlide']['sort_order'];

        $small_image_id =       $project_slide['ProjectSlide']['small_image_id'];
        $small_image_url =      $project_slide['SmallImage']['url'];

        $big_image_id =         $project_slide['ProjectSlide']['big_image_id'];
        $big_image_url =        $project_slide['BigImage']['url'];
        $sort_order =           $project_slide['ProjectSlide']['sort_order'];
    ?>
    <li project_slide_id="<?php echo $project_slide_id;?>"
        class="table-row"
        id="li-<?php echo $project_slide_id;?>">
        <div class="td-div td-id">
            <h2><?php echo $project_slide_id;?></h2>
        </div> <div class="td-div td-image">
            <?php echo $html->image($small_image_url, array(
                'class' => 'show-image',
                'height' => 30
            )); ?>
            <div append_to="div-dialog-small-image-<?php echo $project_slide_id;?>"
                 class="link-dialog"
                 id="link-dialog-small-image-<?php echo $project_slide_id;?>">
                <a href="#" onclick="return false;" style="width: 100%;">
                    Загрузить
                </a>
            </div>
            <div class="div-dialog"
                 id="div-dialog-small-image-<?php echo $project_slide_id;?>"
                 title="Загрузка маленького изображения"
                 dialog_height="110"
                 append_to="link-dialog-small-image-<?php echo $project_slide_id;?>">
                <input type="file"
                       size="30"
                       class="input-image"
                       name="data<?php
                            if(empty($small_image_id)) {
                                echo "[ProjectSlide][$project_slide_id][small_image_file]";
                            } else {
                                echo "[Image][$small_image_id]";
                            }
                       ?>">
            </div>
        </div> <div class="td-div td-image">
            <?php echo $html->image($big_image_url, array(
                'class' => 'show-image',
                'height' => 30
            )); ?>
            <div append_to="div-dialog-big-image-<?php echo $project_slide_id;?>"
                 class="link-dialog"
                 id="link-dialog-big-image-<?php echo $project_slide_id;?>">
                <a href="#" onclick="return false;" style="width: 100%;">
                    Загрузить
                </a>
            </div>
            <div class="div-dialog"
                 id="div-dialog-big-image-<?php echo $project_slide_id;?>"
                 title="Загрузка большого изображения"
                 dialog_height="110"
                 append_to="link-dialog-big-image-<?php echo $project_slide_id;?>">
                <input type="file"
                       size="30"
                       class="input-image"
                       name="data<?php
                            if(empty($big_image_id)) {
                                echo "[ProjectSlide][$project_slide_id][big_image_file]";
                            } else {
                                echo "[Image][$big_image_id]";
                            }
                       ?>">
            </div>
        </div> <div class="td-div td-sort-order">
            <input class="input-save-all-form input-sort-order textbox-int"
                   value="<?php echo $sort_order;?>"
                   name="data[ProjectSlide][<?php echo $project_slide_id;?>][sort_order]">
        </div> <div class="td-div td-action">
            <select project_slide_id="<?php echo $project_slide_id;?>"
                    class="select-action">
                <option selected="selected" value="0">Выберите действие</option>
                <option value="edit_about">Редактировать описание</option>
                <option value="connect_with_catalogs">Привязка к каталогам</option>
                <option value="delete">Удалить</option>
            </select>
        </div>
    </li>
    <?php } ?>

    <?php echo $form->create('ProjectSlide', array(
        'action' => 'save_list',
        'id' => 'project-slide-save-all',
        'type' => 'file'
    ));?>
    <div id="div-project-slide-save-all" style="display: none;">
    </div>
    <?php echo $form->end();?>

    <a id="link-project-slide-save-all" href="#" onclick="return false;">Сохранить</a>
</ul>

<script type="text/javascript">
    var webroot = '<?php echo $this->webroot; ?>';

    <?php
    $project_slides_notes = Set::combine($project_slides, '{n}.ProjectSlide.id', '{n}.ProjectSlide.about');
    $project_slides_catalogs = Set::combine($project_slides, '{n}.ProjectSlide.id', '{n}.ProjectSlideCatalog.{n}.catalog_id');
    ?>
    var project_slides_notes = <?php echo $javascript->object($project_slides_notes);?>;
    var notes = {
        'note': {
            name: 'data[about]',
            title: 'Редактирование описания',
            notes: project_slides_notes
        }
    };
    var project_slides_catalogs = <?php echo $javascript->object($project_slides_catalogs);?>;
    <?php $catalog_short_list = Set::combine($catalog_list, '{n}.value', '{n}.name');?>
    var catalog_list = <?php echo $javascript->object($catalog_short_list);?>;

    $(document).ready(function() {
        enable_validation();
        enable_image_show();
        enable_link_dialog();

        $('.input-save-all-form').change(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });
        $('.input-save-all-form').keypress(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });

        $('.link-dialog').click(function() {
            $(this).parent().addClass('div-changed');
        });

        $('.input-image').change(function() {
            $(this).addClass('input-file-changed');
        });

        $('#link-project-slide-save-all').click(function() {
            $('.input-changed').clone().appendTo('#div-project-slide-save-all');
            $('.input-file-changed').appendTo('#div-project-slide-save-all');

            $('#project-slide-save-all').submit();
        });

        $('#table-body').sortable({
            scrollSpeed: 5,
            update: function(event, ui) {
                var array = $('#table-body').sortable('toArray');
                for(var key in array) {
                    var li_id = array[key];
                    $('#'+li_id).find('.input-sort-order').val(parseInt(key)+1);
                }
                $('.input-sort-order').parent().addClass('div-changed');
                $('.input-sort-order').addClass('input-changed');
            }
        });

        $('.select-action').change(function() {
            var action = $(this).val();
            var project_slide_id = $(this).attr('project_slide_id');
            switch(action) {
                case 'edit_about':
                    show_edit_note('note', project_slide_id, project_slide_id);
//                    $('#dialog-edit-note').dialog('option', 'title', 'Редактирование описания');
//                    $('#text-edit-note').attr('name', 'data[about]');
//                    $('#text-edit-note').val(project_slides_notes[project_slide_id]);
//                    $('#input-edit-note-project-slide-id').val(project_slide_id);
//                    $('#caption-edit-note-project-slide-id').html(project_slide_id);
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'connect_with_catalogs':
                    initialize_dialog_connect_with_catalogs(project_slide_id);
                    break;
                case 'delete':
                    $('#input-delete-project-slide-id').val(project_slide_id);
                    $('#caption-delete-project-slide-id').html(project_slide_id);
                    $('#dialog-delete-project-slide').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    });
</script>

<div id="dialog-add-project-slide">
    <?php
    echo $form->create('ProjectSlide', array(
        'action' => 'add',
        'id' => 'form-add-project-slide',
        'type' => 'file'
    ));
    ?>
    <div class="div-row-add-project-slide">
        <div class="label-add-project-slide">
            Мал. изобр-е
        </div>
        <div class="div-input-add-project-slide">
            <?php
            echo $form->file('small_image_file', array(
                'id' => 'input-add-project-slide-small-image'
            ));
            ?>
        </div>
    </div>
    <div class="div-row-add-project-slide">
        <div class="label-add-project-slide">
            Бол. изобр-е
        </div>
        <div class="div-input-add-project-slide">
            <?php
            echo $form->file('big_image_file', array(
                'id' => 'input-add-project-slide-big-image'
            ));
            ?>
        </div>
    </div>
    <input type="hidden"
           name="data[project_id]"
           value="<?php echo $project['Project']['id'];?>"/>
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-add-project-slide').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    title: 'Добавление изображения в проект',
    dialogClass: 'widget-add-project-slide',
    resizable: true,
    height: 'auto',
    width: 400,
    buttons: {
        'Сохранить': function() {
            $('#form-add-project-slide').submit();
        },
        'Отмена' : function() {
            $('#dialog-add-project-slide').dialog('close');
        }
    }
});

$('#link-add-project-slide').click(function() {
    $('#input-add-project-slide-small-image').val('');
    $('#input-add-project-slide-big-image').val('');
    $('#dialog-add-project-slide').dialog('open');
});
</script>

<div id="dialog-edit-note">
    <h4 id="title-edit-note-project-slide-id"></h4>
    <h3 id="caption-edit-note-project-slide-id" class="caption-project-slide-id"></h3>
    <?php
    echo $form->create('ProjectSlide', array(
        'action' => 'edit_about',
        'id' => 'form-edit-note'
    ));
    ?>
    <textarea id="text-edit-note" name="data[note]"></textarea>
    <input type="hidden" value="" id="input-edit-note-id" name="data[project_slide_id]">
    <input type="button" id="btn-cancel-edit-note" value="Отмена">
    <input type="submit" id="btn-submit-edit-note" value="Сохранить">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#btn-cancel-edit-note').click(function() {
    $('#dialog-edit-note').hide();
});
$('#dialog-edit-note').appendTo(document.body);

var editor = CKEDITOR.replace('text-edit-note');

function show_edit_note(type, id, caption) {
    var note = notes[type];
    $('#title-edit-note-project-slide-id').html(note.title);
    $('#caption-edit-note-project-slide-id').html(caption);
    $('#input-edit-note-id').val(id);
    $('#text-edit-note').attr('name', note.name);
    editor.setData(note.notes[id]);

    var dlg = $('#dialog-edit-note');
    var dlg_width = dlg.width();
    var dlg_height = dlg.height();
    var scroll_top = $(window).scrollTop();
    var win_width = $(window).width();
    var win_height = $(window).height();

    dlg.css('left', (win_width-dlg_width)/2);
    dlg.css('top', scroll_top+(win_height-dlg_height)/2)
    dlg.show();
}
</script>

<div id="dialog-delete-project-slide">
    <h3 id="caption-delete-project-slide-id" class="caption-project-slide-id"></h3>
    <?php
    echo $form->create('ProjectSlide', array(
        'action' => 'delete',
        'id' => 'form-delete-project-slide'
    ));
    ?>
    <input type="hidden" value="" id="input-delete-project-slide-id"
           name="data[project_slide_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-delete-project-slide').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-delete-product',
    title: 'Удаление изображение проекта',
    resizable: true,
    buttons: {
        'Удалить': function() {
            $('#form-delete-project-slide').submit();
        },
        'Отмена' : function() {
            $('#dialog-delete-project-slide').dialog('close');
        }
    }
});
</script>

<div id="dialog-connect-with-catalogs">
    <h3 id="caption-connect-with-catalogs-project-slide-id" class="caption-project-slide-id"></h3>
    <ul id="ul-dialog-connect-with-catalogs">
    </ul>
    <div class="div-row-connect-with-catalogs">
        <div class="label-connect-with-catalogs">
            Выберите каталог
        </div>
        <a id="link-connect-with-catalogs-add-catalog"
           href="#"
           onclick="return false"
           title="добавить">
            <?php echo $html->image('add.png');?>
        </a>
        <div class="div-input-connect-with-catalogs">
            <?php
            echo $form->select('', $catalog_list, null, array(
                'id' => 'select-connect-with-catalogs-catalog'
            ), false);
            ?>
        </div>
    </div>
    <?php
    echo $form->create('ProjectSlide', array(
        'action' => 'connect_with_catalogs',
        'id' => 'form-connect-with-catalogs'
    ));
    ?>
    <input type="hidden" value="" id="input-connect-with-catalogs-project-slide-id" name="data[project_slide_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
var dialog_connect_with_catalogs_actions = [];

$('#link-connect-with-catalogs-add-catalog').click(function() {
    var catalog_id = $('#select-connect-with-catalogs-catalog').val();
    var link_delete = ' <a title="удалить" href="#" onclick="return false;" catalog_id="'+catalog_id+'" class="link-delete-catalog">'+
        '<img src="'+webroot+'img/delete.png"></a>';
    var new_li = $('<li style="display: none;">'+catalog_list[catalog_id]+link_delete+'</li>');
    $('#ul-dialog-connect-with-catalogs').append(new_li);
    new_li.show(400);
    dialog_connect_with_catalogs_actions.push({
        'type': 'add',
        'catalog_id': catalog_id
    });
    $(new_li).find('.link-delete-catalog').click(function() {
        var catalog_id = $(this).attr('catalog_id');
        dialog_connect_with_catalogs_actions.push({
            'type': 'delete',
            'catalog_id': catalog_id
        });
        $(this).parent().hide(400, function() {
            $(this).remove();
        });
    });
});

function initialize_dialog_connect_with_catalogs(project_slide_id) {
    $('#caption-connect-with-catalogs-project-slide-id').html(project_slide_id);
    $('#input-connect-with-catalogs-project-slide-id').val(project_slide_id);

    dialog_connect_with_catalogs_actions = [];
    $('#form-connect-with-catalogs .action').remove();
    var project_slide_catalogs = project_slides_catalogs[project_slide_id];
    $('#ul-dialog-connect-with-catalogs').html('');
    for(var catalog_key in project_slide_catalogs) {
        var catalog_id = project_slide_catalogs[catalog_key];
        var link_delete = ' <a title="удалить" href="#" onclick="return false;" catalog_id="'+catalog_id+'" class="link-delete-catalog">'+
            '<img src="'+webroot+'img/delete.png"></a>';
        $('#ul-dialog-connect-with-catalogs').append('<li>'+catalog_list[catalog_id]+link_delete+'</li>');
    }
    $('.link-delete-catalog').click(function() {
        var catalog_id = $(this).attr('catalog_id');
        dialog_connect_with_catalogs_actions.push({
            'type': 'delete',
            'catalog_id': catalog_id
        });
        $(this).parent().hide(400, function() {
            $(this).remove();
        });
    });

    $('#dialog-connect-with-catalogs').dialog('open');
}

$('#dialog-connect-with-catalogs').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-connect-with-catalogs',
    title: 'Привязка к каталогам',
    resizable: true,
    width: 400,
    height: 'auto',
    buttons: {
        'Сохранить': function() {
            for(var action_key in dialog_connect_with_catalogs_actions) {
                var action = dialog_connect_with_catalogs_actions[action_key];
                $('#form-connect-with-catalogs').append(
                    '<input type="hidden" class="action" name="data[actions]['+action_key+'][type]" value="'+action.type+'">'
                );
                $('#form-connect-with-catalogs').append(
                    '<input type="hidden" class="action" name="data[actions]['+action_key+'][catalog_id]" value="'+action.catalog_id+'">'
                );
            }
            $('#form-connect-with-catalogs').submit();
        },
        'Отмена' : function() {
            $('#dialog-connect-with-catalogs').dialog('close');
        }
    }
});
</script>