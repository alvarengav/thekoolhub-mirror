var data_uri = '<?= "{$appController}-{$appFunction}" ?>';
var data_list = typeof localStorage != 'undefined' ? localStorage.getItem('data-list-' + data_uri) : false;

if(DataT)
{
  var settings = DataT.fnSettings();
  var column = settings.aoColumns[settings.aaSorting[0][0]]['mData'];
  var new_data = {
    'listSort'      : column,
    'listSortType'  : settings.aaSorting[0][1],
    'listStart'     : settings._iDisplayStart,
    'listPagination': settings._iDisplayLength
  };

  aoData.push( { 'name': 'filter-sort-column', 'value': column } );
  aoData.push( { 'name': 'filter-sort-type', 'value': settings.aaSorting[0][1] } );
  
  var data_json = JSON.stringify(new_data);
  if ( ! data_list || data_list != data_json)
  {
    if (typeof localStorage != 'undefined' && data_json)
    {
      localStorage.setItem('data-list-' + data_uri, data_json);      
    }
    /*$.ajax({
      url: '<?= base_url() ?>app/session',
      dataType: 'json',
      type: 'POST',
      data: {item: data_uri, values: new_data},
    }); */
  }
}
else
{
  data_list = data_list ? JSON.parse(data_list) : [];
  <? if ( ! empty($appDSess->listSort)): ?>
  data_list = <?= json_encode($appDSess) ?: '[]' ?> || data_list;
  <? endif ?>
  if (data_list && data_list.listSort)
  {
    aoData.push( { 'name': 'filter-sort-column', 'value': data_list.listSort } );
    aoData.push( { 'name': 'filter-sort-type', 'value': data_list.listSortType } );  
    var sort = 0;
    $.each(configDT.aoColumns, function(index, item){
      if(item['mData'] == data_list.listSort && ! sort)    
      {
        return sort = index;
      }
    });
    configDT.aaSorting[0][0] = sort;
    configDT.aaSorting[0][1] = data_list.listSortType;
    configDT.aaSorting[0][2] = (configDT.aaSorting[0][1] == 'asc') ? 0 : 1;
  }
}
