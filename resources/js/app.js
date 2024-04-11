import './bootstrap';


function stop_animation() {
    if ($('.modal-mask').length) {
        $('.modal-mask').remove()
    }
}
function load_animation() {
    var loading = new Loading({

        // 'ver' or 'hor'
        direction: 'ver',

        // loading title
        title: 'در حال پردازش اطلاعات',

        // text color
        titleColor: '#FFF',

        // font size
        titleFontSize: 14,

        // extra class(es)
        titleClassName: undefined,

        // font family
        titleFontFamily: undefined,

        // loading description
        discription: 'لطفا صبر گنید',

        // text color
        discriptionColor: '#FFF',

        // font size
        discriptionFontSize: 14,

        // extra class(es)
        discriptionClassName: undefined,

        // font family
        directionFontFamily: undefined,

        // width/height of loading indicator
        loadingWidth: 'auto',
        loadingHeight: 'auto',

        // padding in pixels
        loadingPadding: 20,

        // background color
        loadingBgColor: '#252525',

        // border radius in pixels
        loadingBorderRadius: 12,

        // loading position
        loadingPosition: 'fixed',

        // shows/hides background overlay
        mask: true,

        // background color
        maskBgColor: 'rgba(0, 0, 0, .6)',

        // extra class(es)
        maskClassName: undefined,

        // mask position
        maskPosition: 'fixed',

        // 'image': use a custom image

        // path to loading spinner
        animationSrc: undefined,

        // width/height of loading spinner
        animationWidth: 40,
        animationHeight: 40,
        animationOriginWidth: 4,
        animationOriginHeight: 4,

        // color
        animationOriginColor: '#FFF',

        // extra class(es)
        animationClassName: undefined,

        // auto display
        defaultApply: true,

        // animation options
        animationIn: 'animated fadeIn',
        animationOut: 'animated fadeOut',
        animationDuration: 1000,

        // z-index property
        zIndex: 0,

    });
}

window.onload = function () {

    stop_animation()
    $("form").submit(function (e) {
        load_animation()
    });

    $("a").click(function (e) {
        if (!$(this).hasClass("no_link")) {
            load_animation()

        }
    });
    const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/advertiser/add_tiny_image');
        xhr.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector('meta[name="csrf-token"]').content);

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (blobInfo.blob().size > 1024 * 1024) {
                return reject({message: 'File is too big!', remove: true});
              }

            if (xhr.status === 403) {
                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = () => {
          reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });
    if ($('#tiny').length) {
        tinymce.init({
            selector: '#tiny',
            plugins: ["image","emoticons"],
                   height: 500,
            menubar: false,
            toolbar: 'emoticons forecolor backcolor |undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image | color',

            // without images_upload_url set, Upload tab won't show up
            images_upload_url: 'upload.php',

            // override default upload handler to simulate successful upload
            images_upload_handler: image_upload_handler_callback
        });
        // tinymce.init({
        //     selector: '#tiny',
        //     height: 500,
        //     menubar: false,
        //     plugins: [
        //             "advlist directionality autolink autosave link image lists charmap print preview hr anchor pagebreak",
        //             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        //             "table contextmenu textcolor paste textcolor"
        //     ],
        //     toolbar: 'undo redo | blocks | bold italic backcolor | ' +
        //       'alignleft aligncenter alignright alignjustify | ' +
        //       'bullist numlist outdent indent | removeformat | help'

        //       ,
        //       image_title: true,
        //       automatic_uploads: true,
        //       file_picker_types: 'image',
        //       /* and here's our custom image picker*/
        //       file_picker_callback: function (cb, value, meta) {
        //         var input = document.createElement('input');
        //         input.setAttribute('type', 'file');
        //         input.setAttribute('accept', 'image/*');

        //         /*
        //           Note: In modern browsers input[type="file"] is functional without
        //           even adding it to the DOM, but that might not be the case in some older
        //           or quirky browsers like IE, so you might want to add it to the DOM
        //           just in case, and visually hide it. And do not forget do remove it
        //           once you do not need it anymore.
        //         */

        //         input.onchange = function () {
        //           var file = this.files[0];

        //           var reader = new FileReader();
        //           reader.onload = function () {
        //             /*
        //               Note: Now we need to register the blob in TinyMCEs image blob
        //               registry. In the next release this part hopefully won't be
        //               necessary, as we are looking to handle it internally.
        //             */
        //             var id = 'blobid' + (new Date()).getTime();
        //             var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        //             var base64 = reader.result.split(',')[1];
        //             var blobInfo = blobCache.create(id, file, base64);
        //             blobCache.add(blobInfo);

        //             /* call the callback and populate the Title field with the file name */
        //             cb(blobInfo.blobUri(), { title: file.name });
        //           };
        //           reader.readAsDataURL(file);
        //         };

        //         input.click();
        //       },
        //   });
    }

    $('#send_pay').on("click", function (e) {
        $(this).closest("form").submit()

    })
    function update_app_price() {
        // let type = $('input[name="count_type"]:checked').val()
        // let val_click = $('#click_count').data("price");
        // let val_view = $('#view_count').data("price");
        // let click_count = $('#click_count').val()
        // let view_count = $('#view_count').val()
        // console.log(val)
        // console.log(type)
        // console.log(click_count)
        // console.log(view_count)
        // let total_click = click_count
        // val_click *= total_click

        // let total_view = view_count
        // val_view *= total_view

        // let tax = Math.floor(val + ((4.5 * val) / 100))
        // console.log((4.5 * val) / 100)
        // console.log(tax)
        // let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        // tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        // // val = val.num2persian()
        // if (type == "view") {
        //     $('.totoal_price_view').text(num + " تومان")
        // } else {
        //     $('.totoal_price_click').text(num + " تومان")
        // }
        // $('.totoal_price').text(num + " تومان")
        // $('.after_tax_price').text(tax + " تومان")
    }


    $('.copy').on("click", function (e) {
        let el = $(this);
        let url = (el.data("url"));
        url=`<script  src="${url}"></script>`
        navigator.clipboard.writeText(url).then(
            function() {
                Swal.fire({
                    toast: true,
                    position: "top-center",
                    text: "متن  کپی شد !",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                  });
            },
            function() {
            }
          )
       })
    $('#click_count').on("change keyup", function (e) {
        let el = $(this);
        let price = Number(el.data("price"));
        let val = Number(el.val());
        val*=price
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price_click').text(num)
        let tax = Math.floor(val + ((4.5 * val) / 100))
         tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
         $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })
    $('.remove_faq').on("click", function (e) {
        let el = $(this);
        let id = (el.data("id"));

        $.ajax('/admin/faq/'+id, {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            data:{_method:"delete"},
            datatype: 'json',
            success: function (data) {
                console.log(data)
                el.closest(".par").slideUp(400)

            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })


    })


    $('#view_count').on("change keyup", function (e) {
        let el = $(this);
        let price = Number(el.data("price"));
        let val = Number(el.val());
        val*=price
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price_view').text(num)
        let tax = Math.floor(val + ((4.5 * val) / 100))
         tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
         $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })


    // $('.dropdown-toggle').on("click", function (e) {
    //     let el=$(this)
    //     el.closest("li.dropdown").find(".dropdown-menu").toggleClass("show")
    //  })
    // $('body').on("click", function (e) {
    // console.log("dddddddddd")
    //     $(".dropdown.show").toggle();
    //     $(".dropdown.open").toggle();

    //  })
    $('input[name="count_type"]').on("click", function (e) {
       $('.cal_p').val("")
       $('.totoal_price_view').text("")
       $('.totoal_price_click').text("")
       $('.totoal_price').text(0 + " تومان")
       $('.after_tax_price').text(0 + " تومان")
    })
    $('.per_price').on("click", function (e) {
        let el = $(this);
        let val = el.data("price");
        console.log(val)
        $('#amount').val(val)


        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')

        console.log(num)
        val = val.num2persian()
        $('.persian_number').text(val + " تومان")
        $('#amount_total').text(num + " تومان")
        $('.amount_total').text(num + " تومان")
    })
    $('#order_count').on("keyup change", function (e) {
        let el = $(this);
        let val = Number(el.val());
        let price = Number($('#price').val());
        val *= price
        let tax = Math.floor(val + ((4.5 * val) / 100))
        console.log((4.5 * val) / 100)
        console.log(tax)
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        // val = val.num2persian()
        $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })

    $('.add_active').change(function(){
    // $('.add_active').on("change", function (e) {
        let el = $(this);
        let id = el.data("id");
        load_animation()
        $.ajax('/advertiser/add_active/'+id, {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            datatype: 'json',
            success: function (data) {
                console.log(data)
                stop_animation()
                $('label[for="add_active' + id + '"]').text(data.active?"فعال ":"غیر فعال");

            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })
   })
    $('.number_format').on("keyup change", function (e) {
        let el = $(this);
        let val = el.val();
        console.log(60)
        if (val > 0) {
            let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')

            console.log(num)
            val = val.num2persian()
            $('.persian_number').text(val + " تومان")
            $('#amount_total').text(num + " تومان")
            $('.amount_total').text(num + " تومان")
            // if (el.closest('.col-12').find('.green_label').length) {
            //     console.log(80)
            //     console.log(num)
            //     el.closest('.col-12').find('.green_label').html(val + " تومان" + num)
            //     el.closest('.col-12').find('.yellow_label').html(num + " تومان" + num)
            // } else {
            //     console.log(70)
            //     console.log(num)
            //     el.closest('.col-12').append(`
            //     <p class="yellow_label badge badge-success">
            //     ${num}
            //     </p>
            //     <p class="green_label badge badge-success">  ${val} -     ${num}
            //     تومان</p>


            //     `)
            // }

        } else {
            $('.persian_number').text(0 + " تومان")
            $('#amount_total').text(0 + " تومان")
        }
    })



    console.log(8080)
    if ($('.select2').length) {
        console.log(8080)
        $('.select2').select2();
    }
    if ($('#box_chat').length) {

        $('#box_chat').scrollTop($('#box_chat')[0].scrollHeight);
    }
    // if ($('.persian_date').length) {
    //     $(".persian_date").pDatepicker(
    //         {
    //             "altField": '#timestamp',
    //             "initialValue": false,
    //             "observer": true,
    //             "autoClose": true,
    //             "format": 'YYYY/MM/DD'
    //         }
    //     );
    // }
    // if ($('.tooltiper').length) {
    //     $('.tooltiper').tooltipster();
    // }
    $(document).on('click', '.confirm_reject', function (event) {
        let el =$(this)
        Swal.fire({
            title: "در صورت تایید تبلیغ برای همیشه غیر فعال شده و باقیمانده شارژ به حساب شما باز میگردد?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "تایید",
            denyButtonText: `ی خیال`
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                el.closest('form').submit()
            } else if (result.isDenied) {
            }
          });

    });
    $(document).on('change', 'input[name="priod"]', function (event) {
        let el =$(this)
        console.log(el.val())
        $(".date-picker").val('')
    });
    $(document).on('click', '.date-picker', function (event) {
        console.log(12)
        $('input[name="priod"]').prop("checked", false);
        $('input[name="priod"]').removeAttr("checked");
    });
    $(document).on('change', '#file_select', function (event) {
        let el=$(this)
        var filename = el.val().split('\\').pop();
        $('.file_name').text(filename)
    });
    $(document).on('change', '#file_select', function (event) {
        let el=$(this)
        var filename = el.val().split('\\').pop();
        $('.file_name').text(filename)
    });
    $(document).on('click', '.form_close', function (event) {
        let el=$(this)
        console.log(12)
        el.closest("form").submit()
    });
    let count = 0
    $(document).on('click', '#check_code', function (event) {

        let code = $('#code').val()
        if (count == 3) {
            Swal.fire({
                text: "تعداد سعی شما  بیشتر از حد مجاز هست!",
                showConfirmButton: false,
                timer: 1500,
                icon: "error",
            });
            setTimeout(() => {
                location.reload();
            }, 2000);
            return
        }

        if (!code) {
            Swal.fire({
                text: "لطفا کد   را به درستی وارد کنید!",
                showConfirmButton: false,
                timer: 1500,
                icon: "error",
            });
            return
        }

        load_animation()
        $.ajax('/check_code', {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            data: { code: code },
            datatype: 'json',
            success: function (data) {
                console.log(data)
                stop_animation()
                if (data.status == "ok") {
                    window.location.href = "/redirect"

                } else {
                    count++
                    Swal.fire({
                        text: "لطفا کد   را به درستی وارد کنید!",
                        showConfirmButton: false,
                        timer: 1500,
                        icon: "error",
                    });
                }



            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })
    });


    $(document).on('click', '#wrong', function (event) {

        $('#first').slideDown(400)
        $('#second').slideUp(400)
        $('#mobile').val("")

    });
    $(document).on('click', '#send_code', function (event) {
        let mobile = $('#mobile').val()

        var regex = new RegExp("^(\\+98|0)?9\\d{9}$");
        var result = regex.test(mobile);
        if (!result) {
            Swal.fire({
                text: "لطفا همراه خود را به درستی وارد کنید!",
                showConfirmButton: false,
                timer: 1500,
                icon: "error",
            });
            return
        }
        $('.mobile').text(mobile)
        load_animation()
        $.ajax('/mobile_login', {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            data: { mobile: mobile },
            datatype: 'json',
            success: function (data) {
                console.log(data);
                stop_animation()
                $('#first').slideUp(400)
                $('#second').slideDown(400)


            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })

    });








}


