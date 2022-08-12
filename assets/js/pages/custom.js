$(document).ready(function(){
  var base_url = "http://127.0.0.1/ta_nauval/";
  var global = [];
      var ExcelToJSON = function() {
        this.parseExcel = function(file) {
          var reader = new FileReader();
          reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
              type: 'binary'
            });
            workbook.SheetNames.forEach(function(sheetName) {
              // Here is your object
              var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
              var json_object = JSON.stringify(XL_row_object);
              json_object = JSON.parse(json_object);
              global = json_object;
              if(global.length > 0){
                var index = global[0];
                index = Object.keys(index);
                console.log(global);
                $.post(base_url+'operation/savedata',{data:global,index:index},function(data,status){
                  if(status=="success"){
                    location.reload();
                  }
                });
              }else{
                alert('File Excel tidak terbaca, mohon lihat contoh dahulu');
              }
            })
          };
          reader.onerror = function(ex) {
            alert('Ekstensi File Harus Excel, xls / xlsx');
          };
          reader.readAsBinaryString(file);
        };
    };
    function validasi(json_object){
      var val = 0;
      for(var x=0;x<json_object.length;x++){
          if(json_object[x].nama_sekolah == '' || json_object[x].nama_sekolah == null){
            val++;
          }

      }
      if(val > 0){
        return false;
      }else{
        return true;
      }
    }
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        var xl2json = new ExcelToJSON();
        xl2json.parseExcel(files[0]);
    }
    var areaOption = document.getElementById('upload');
        if (areaOption) {
          document.getElementById('upload').addEventListener('change', handleFileSelect, false);
    }

});
