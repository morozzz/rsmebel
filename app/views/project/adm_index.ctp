<h1>Редактирование портфолио</h1>

<div class="div-warning"> * Внимание: для корректного отображения проектов портфолио,
сортировка должна быть выставлена целыми числами от 1 до n, где n - количество проектов</div>

<div class="div-add-action">
    <a id="link-add-project" href="#" onclick="return false;">Добавить</a>
</div>

<div id="table-header">
    <div class="td-name">Название</div>
    <div class="td-profile">Профиль</div>
    <div class="td-image">Мал. изобр-е</div>
    <div class="td-image">Бол. изобр-е</div>
    <div class="td-address">Адрес</div>
    <div class="td-sort-order">Сорт-ка</div>
    <div class="td-action">Действие</div>
</div>

<ul id="table-body">
    <?php foreach($projects as $project) {
        $project_id =           $project['Project']['id'];
        $name =                 $project['Project']['name'];
        $address =              $project['Project']['address'];
        $sort_order =           $project['Project']['sort_order'];

        $project_profile_id =   $project['ProjectProfile']['id'];
        $project_profile_name = $project['ProjectProfile']['name'];

        $small_image_id =       $project['Project']['small_image_id'];
        $small_image_url =      $project['SmallImage']['url'];

        $big_image_id =         $project['Project']['big_image_id'];
        $big_image_url =         $project['BigImage']['url'];
    ?>
    <li project_id="<?php echo $project_id;?>"
        class="table-row"
        id="li-<?php echo $project_id;?>">
        <div class="td-div td-name">
            <input class="input-save-all-form input-name"
                   value="<?php echo $name;?>"
                   name="data[Project][<?php echo $project_id;?>][name]">
        </div> <div class="td-div td-profile">
            <input class="input-profile-name"
                   readonly
                   value="<?php echo $project_profile_name;?>">
            <input class="input-profile-id"
                   type="hidden"
                   value="<?php echo $project_profile_id;?>"
                   name="data[Project][<?php echo $project_id;?>][profile_id]">
        </div> <div class="td-div td-image">
            <?php echo $html->image($small_image_url, array(
                'class' => 'show-image',
                'height' => 30
            )); ?>
            <div append_to="div-dialog-small-image-<?php echo $project_id;?>"
                 class="link-dialog"
                 id="link-dialog-small-image-<?php echo $project_id;?>">
                <a href="#" onclick="return false;" style="width: 100%;">
                    Загрузить
                </a>
            </div>
            <div class="div-dialog"
                 id="div-dialog-small-image-<?php echo $project_id;?>"
                 title="Загрузка маленького изображения"
                 dialog_height="110"
                 append_to="link-dialog-small-image-<?php echo $project_id;?>">
                <input type="file"
                       size="30"
                       class="input-image"
                       name="data<?php
                            if(empty($small_image_id)) {
                                echo "[Project][$project_id][small_image_file]";
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
            <div append_to="div-dialog-big-image-<?php echo $project_id;?>"
                 class="link-dialog"
                 id="link-dialog-big-image-<?php echo $project_id;?>">
                <a href="#" onclick="return false;" style="width: 100%;">
                    Загрузить
                </a>
            </div>
            <div class="div-dialog"
                 id="div-dialog-big-image-<?php echo $project_id;?>"
                 title="Загрузка большого изображения"
                 dialog_height="110"
                 append_to="link-dialog-big-image-<?php echo $project_id;?>">
                <input type="file"
                       size="30"
                       class="input-image"
                       name="data<?php
                            if(empty($big_image_id)) {
                                echo "[Project][$project_id][big_image_file]";
                            } else {
                                echo "[Image][$big_image_id]";
                            }
                       ?>">
            </div>
        </div> <div class="td-div td-address">
            <input class="input-save-all-form input-address"
                   value="<?php echo $address;?>"
                   name="data[Project][<?php echo $project_id;?>][address]">
        </div> <div class="td-div td-sort-order">
            <input class="input-save-all-form input-sort-order textbox-int"
                   value="<?php echo $sort_order;?>"
                   name="data[Project][<?php echo $project_id;?>][sort_order]">
        </div> <div class="td-div td-action">
            <select project_id="<?php echo $project_id;?>"
                    class="select-action">
                <option selected="selected" value="0">Выберите действие</option>
                <option value="go_to_slides">Управление изображениями</option>
                <option value="edit_about">Редактировать описание</option>
                <option value="connect_with_catalogs">Привязка к каталогам</option>
                <option value="delete">Удалить</option>
            </select>
        </div>
    </li>
    <?php } ?>

    <?php echo $form->create('Project', array(
        'action' => 'save_list',
        'id' => 'project-save-all',
        'type' => 'file'
    ));?>
    <div id="div-project-save-all" style="display: none;">
    </div>
    <?php echo $form->end();?>

    <a id="link-project-save-all" href="#" onclick="return false;">Сохранить</a>
</ul>

<script type="text/javascript">
    var webroot = '<?php echo $this->webroot; ?>';

    <?php
    $projects_notes = Set::combine($projects, '{n}.Project.id', '{n}.Project.about');
    $projects_name = Set::combine($projects, '{n}.Project.id', '{n}.Project.name');
    $projects_catalogs = Set::combine($projects, '{n}.Project.id', '{n}.ProjectCatalog.{n}.catalog_id');
    ?>
    var projects_notes = <?php echo $javascript->object($projects_notes);?>;
    var notes = {
        'note': {
            name: 'data[about]',
            title: 'Редактирование описания',
            notes: projects_notes
        }
    };
    var projects_name = <?php echo $javascript->object($projects_name);?>;
    var profiles = <?php echo $javascript->object($project_profile_list);?>;
    var projects_catalogs = <?php echo $javascript->object($projects_catalogs);?>;
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

        $('#link-project-save-all').click(function() {
            $('.input-changed').clone().appendTo('#div-project-save-all');
            $('.input-file-changed').appendTo('#div-project-save-all');

            $('#project-save-all').submit();
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
            var project_id = $(this).attr('project_id');
            switch(action) {
                case 'go_to_slides':
                    window.location = webroot+'project_slides/adm_index/'+project_id;
                    break;
                case 'edit_about':
                    show_edit_note('note', project_id, projects_name[project_id]);
//                    $('#dialog-edit-note').dialog('option', 'title', 'Редактирование описания');
//                    $('#text-edit-note').attr('name', 'data[about]');
//                    $('#text-edit-note').val(projects_notes[project_id]);
//                    $('#input-edit-note-project-id').val(project_id);
//                    $('#caption-edit-note-project-name').html(projects_name[project_id]);
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'connect_with_catalogs':
                    initialize_dialog_connect_with_catalogs(project_id);
                    break;
                case 'delete':
                    $('#input-delete-project-project-id').val(project_id);
                    $('#caption-delete-project-project-name').html(projects_name[project_id]);
                    $('#dialog-delete-project').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    });
</script>

<div id="dialog-profile">
    <div class="div-row-profile">
        <div class="label-profile">
            Выберите профиль
        </div>
        <div class="div-input-profile">
            <?php
            echo $form->select('profile_id',
                    $project_profile_list,
                    null,
                    array(
                        'id' => 'input-profile-profile-id'
                    ),
                    false);
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(".input-profile-name").click(function() {
    var li_project = $(this).parent().parent();
    var project_id = li_project.attr('project_id');
    var input_profile_id = li_project.find('.input-profile-id');
    $('#input-profile-profile-id').val(input_profile_id.val());
    $('#input-profile-profile-id').attr('project_id', project_id);
    $('#dialog-profile').dialog('open');
});

$('#dialog-profile').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-profile',
    title: 'Выбор профиля',
    resizable: true,
    width: 300,
    height: 110,
    buttons: {
        'Выбрать': function() {
            var project_id = $('#input-profile-profile-id').attr('project_id');
            var profile_id = $('#input-profile-profile-id').val();
            var profile_name = profiles[profile_id];

            var li_project = $('#li-'+project_id);
            var input_profile_id = li_project.find('.input-profile-id');
            input_profile_id.val(profile_id);
            input_profile_id.addClass('input-changed');

            var input_profile_name = li_project.find('.input-profile-name');
            input_profile_name.val(profile_name);

            var td_profile = li_project.find('.td-profile');
            td_profile.addClass('div-changed');

            $('#dialog-profile').dialog('close');
        },
        'Отмена' : function() {
            $('#dialog-profile').dialog('close');
        }
    }
});
</script>

<div id="dialog-add-project">
    <?php
    echo $form->create('Project', array(
        'action' => 'add',
        'id' => 'form-add-project'
    ));
    ?>
    <div class="div-row-add-project">
        <div class="label-add-project">
            Название
        </div>
        <div class="div-input-add-project">
            <?php
            echo $form->text('name', array(
                'id' => 'input-add-project-name'
            ));
            ?>
        </div>
    </div>
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-add-project').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    title: 'Добавление проекта в портфолио',
    dialogClass: 'widget-add-project',
    resizable: true,
    height: 115,
    buttons: {
        'Сохранить': function() {
            $('#form-add-project').submit();
        },
        'Отмена' : function() {
            $('#dialog-add-project').dialog('close');
        }
    }
});

$('#link-add-project').click(function() {
    $('#input-add-project-name').val('');
    $('#dialog-add-project').dialog('open');
});
</script>

<div id="dialog-edit-note">
    <h4 id="title-edit-note-project-name"></h4>
    <h3 id="caption-edit-note-project-name" class="caption-project-name"></h3>
    <?php
    echo $form->create('Project', array(
        'action' => 'edit_about',
        'id' => 'form-edit-note'
    ));
    ?>
    <textarea id="text-edit-note" name="data[note]"></textarea>
    <input type="hidden" value="" id="input-edit-note-id" name="data[project_id]">
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
    $('#title-edit-note-project-name').html(note.title);
    $('#caption-edit-note-project-name').html(caption);
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

<div id="dialog-delete-project">
    <h3 id="caption-delete-project-project-name" class="caption-project-name"></h3>
    <?php
    echo $form->create('Project', array(
        'action' => 'delete',
        'id' => 'form-delete-project'
    ));
    ?>
    <input type="hidden" value="" id="input-delete-project-project-id" name="data[project_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-delete-project').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-delete-product',
    title: 'Удаление проекта из портфолио',
    resizable: true,
    buttons: {
        'Удалить': function() {
            $('#form-delete-project').submit();
        },
        'Отмена' : function() {
            $('#dialog-delete-project').dialog('close');
        }
    }
});
</script>

<div id="dialog-connect-with-catalogs">
    <h3 id="caption-connect-with-catalogs-project-name" class="caption-project-name"></h3>
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
    echo $form->create('Project', array(
        'action' => 'connect_with_catalogs',
        'id' => 'form-connect-with-catalogs'
    ));
    ?>
    <input type="hidden" value="" id="input-connect-with-catalogs-project-id" name="data[project_id]">
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

function initialize_dialog_connect_with_catalogs(project_id) {
    var project_name = projects_name[project_id];
    $('#caption-connect-with-catalogs-project-name').html(project_name);
    $('#input-connect-with-catalogs-project-id').val(project_id);

    dialog_connect_with_catalogs_actions = [];
    $('#form-connect-with-catalogs .action').remove();
    var project_catalogs = projects_catalogs[project_id];
    $('#ul-dialog-connect-with-catalogs').html('');
    for(var catalog_key in project_catalogs) {
        var catalog_id = project_catalogs[catalog_key];
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