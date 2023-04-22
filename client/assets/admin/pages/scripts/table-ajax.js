var TableAjax = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(), format: 'dd-mm-yyyy',
            autoclose: true
        });
    }

    var handleRecords = function () {
	
	 var table = $('#datatable_ajax');

	         $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group",
            "buttons": {
                "normal": "btn default yellow-stripe",
                "disabled": "btn default yellow-stripe disabled"
            },
            "collection": {
                "container": "DTTT_dropdown dropdown-menu tabletools-dropdown-menu"
            }
        });

		// Have the collection use a bootstrap compatible dropdown
	$.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
		"collection": {
			"container": "ul",
			"button": "li",
			"liner": "a"
		}
	} );

		

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
                "lengthMenu": [
                    [10,20, 30, 50, 100, -1],
                    [10,20, 30, 50, 100, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "tables/table_users.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            }
        });
		
		
		
		 var oTable = table.dataTable();
		 var tableColumnToggler = $('#sample_4_column_toggler');
					  /* handle show/hide columns*/
        $('input[type="checkbox"]', tableColumnToggler).change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
		
	
	

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            initPickers();
            handleRecords();
        }

    };

}();