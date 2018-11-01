var Event = function () {
    this.__construct = function () {
        this.table();
        this.addLocation();
    };

    this.table = function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    };

    this.addLocation = function () {
        $("#add-location").submit(function (evt) {
            evt.preventDefault();
            var form = $(this)[0];
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (out) {
                    if (out.result === 0) {
                        $(".col-md-3 > .error").remove();
                        for (var i in out.errors) {
                            $("#" + i).parents(".col-md-3").append('<span class="error">' + out.errors[i] + '</span>');
                        }
                    }
                    if (out.result === -1) {
                        $(".col-md-3 > .error").remove();
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-success alert-danger').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
                    }
                    if (out.result === 1) {
                         window.location.href = out.url;
                    }
                }
            });
        });
    };
    
    this.__construct();
};
var obj = new Event();