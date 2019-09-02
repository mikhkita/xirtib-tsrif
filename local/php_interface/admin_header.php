<!-- <script src="/local/templates/main/js/jquery.js"></script> -->
<?/* 
// if( $_SERVER["SCRIPT_NAME"] == "/bitrix/admin/iblock_section_edit.php" && $_REQUEST["IBLOCK_ID"] == 14 ):
?>
<? CJSCore::Init( 'jquery' ); ?>
<script>

    $(document).ready(function(){   
        function highlight(){
            var index = 0;
            $('tr.main-grid-row-head').find('th').each(function(i){
                var text = $(this).find('.main-grid-head-title').text();
                if (text == "Активность") {
                    index = i;
                    return false;
                }
            });

            $('.main-grid-table').find('.main-grid-row').each(function(){
                if ($(this).find('td').eq(index).find('span').text() == "Нет") {
                    $(this).addClass('no-active');
                }
            })
        }

        highlight();

        setInterval(function(){
            highlight();
        },100);

        $(".adm-info-message-wrap").each(function(){
            if( !$(this).find("a:contains(SiteUpdate)").length ){
                $(this).css("display", "block");
            }
        });
    })
</script>
<style>
    .adm-info-message-wrap{
        display: none;
    }
    .no-active td{
        background-color: #e7e9ea;
    }
    .no-active:hover td{
        background-color: #dae0e2 !important;
    }
</style>

<?

$arGroups = CUser::GetUserGroup($USER->GetId());

?>
<? if( in_array(6, $arGroups) ): ?>
    <style>
        .adm-content, .adm-marketing, .adm-store{
            display: none;
        }
    </style>
<? endif; ?>
<script>
    // опишем всплывающее окно (средствами Битрикса)
    // var Dialog = new BX.CDialog({
    //     title: "Переотправка писем",
    //     content: '<div id="all_orders"></div>', // в этот div будем вставлять инфу, полученную функцией orders_ms()
    //     icon: 'head-block',
    //     resizable: true,
    //     draggable: true,
    //     height: '400',
    //     width: '600',
    //     buttons: [BX.CDialog.btnClose]
    // });

    // теперь функция
    function sendTo1C(id) { 
        // теперь в ajax-е обратимся к странице, на которой выполним нужный нам код и отправим письмо
        BX.ready(function () {
            // Dialog.title = "Тест";
            // Dialog.Show(); // вызвали окно, которое описано выше

            BX.ajax({
                method: 'GET',
                dataType: 'html',
                url: '/api/resendOrder.php?ID='+id,
                onsuccess: function(data){
                    alert(data);
                    // BX('all_orders').innerHTML = data; 
                    // Dialog.Show(); // вызвали окно, которое описано выше
                },
                onfailure: function(){
                    alert('Возникла ошибка');
                }
            });
        })
    }
</script> 
<? 
if( $_SERVER["SCRIPT_NAME"] == "/bitrix/admin/update_system.php" ):
?>
<style>
    .adm-info-message-red{
        display: none !important;
    }
</style>
<? endif; ?>
<?
*/ 
// endif; 
?>