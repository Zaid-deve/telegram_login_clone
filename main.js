$(document).ready(function () {

    let focusInp = $("#tg-country-code"),
        key_pressed = null


    $("#tg-phone-number,#tg-country-code").on("focus", function () { focusInp = $(this) })

    window.onkeydown = (e) => key_pressed = e.keyCode
    window.onkeyup = function (e) {
        if (!["tg-country-code", "tg-phone-number"].includes(document.activeElement.id)) {
            add_num(e.key)
        }
    }

    $("#tg-phone-number,#tg-country-code").on('input', async function (e) {
        let char = String.fromCharCode(key_pressed),
            val = $(this).val(),
            last = val.slice(-1)

        if (key_pressed && key_pressed == 8) {
            $(this).val(val + last)
            return remove_num();
        }

        $(this).val(val.slice(0, val.length - 1))

        if ([0, 1, 2, 3, 4, 5, 6, 7, 8, 9].includes(Number(last))) {
            add_num(last)
        }
    })

    $("#tg-country-code").on("keyup", function () {
        $(".tg-field-country span").text('')
        $('.tg-field-1').addClass('hide')
        showCountryInfo();
    })

    async function showCountryInfo() {
        if ($("#tg-country-code").val() != '') {
            const res = await getCountryInfo($("#tg-country-code").val())
            if (res.s == 'not-found') return;

            $(".tg-field-country span").text(res.n)
            $("#country-icon").prop('src', res.f)
            $('.tg-field-1').removeClass('hide')
        }
    }


    function add_num(num) {
        if (!num) return;
        focusInp.focus()
        let val = focusInp.val()
        if (focusInp.prop("id") == "tg-phone-number") {
            if (focusInp.val().length >= 5) {
                if (val.length > 11) return;
                val = val.replace("  ", "")
                val = val.slice(0, 5) + "  " + val.slice(5)
            }
        } else {
            if (val.length > 3) return;
        }

        focusInp.val(val + num);
    }

    function remove_num() {
        focusInp.focus()
        let val = focusInp.val().replace("  ", "")

        if (focusInp.prop("id") == "tg-phone-number") {
            if (focusInp.val().length <= 0) {
                $("#tg-country-code").focus().prop("selectionStart", $("#tg-country-code").val().length)
                return;
            }

            if (val.length > 6) val = val.slice(0, 5) + "  " + val.slice(5, val.length - 1);
            else val = val.slice(0, val.length - 1)
        } else {
            val = val.slice(0, val.length - 1)
        }
        focusInp.val(val);

    }

    async function getCountryInfo(code) {
        const response = await fetch("countries.json")
        if (response.ok) {
            const result = await response.json()
            for (let c of result) {
                if (c['dial_code'] == `+${code}`) {
                    return {
                        s: "found",
                        n: c['name'],
                        f: `https://flagsapi.com/${c['code']}/shiny/64.png`
                    }
                }
            }
        }
        return { s: 'not-found' };
    }

    $(".btn-tg-add").click(function () {
        add_num($(this)[0].dataset.num)
    })
    $(".btn-tg-clear").click(function () {
        remove_num()
    })

    $(".tg-close").click(function () {
        $(".country-list-box").addClass('hide')
        $(".tg-header").removeClass('show')
    })

    $(".tg-btn-submit").click(function () {
        let code = $("#tg-country-code").val(),
            number = $("#tg-phone-number").val()

        if (code && number) {
            $(".confirm-outer").addClass('show')
            $(".confirm-number").text("+" + code + " " + number)
            $("body").css("overflow", "hidden")
        } else $(".tg-field-2").addClass("toggle").on('animationend webkitAnimationEnd', function () {
            $(this).removeClass('toggle')
        })
    })

    $('.btn-send').click(async function () {
        // prepare data 
        const data =
            `code=${$("#tg-country-code").val()}&number=${$("#tg-phone-number").val().replace("  ","")}`


        $(".tg-check-data,.tg-btn-submit").children()[0].classList="ri-loader-4-line"
        $(".tg-check-data,.tg-btn-submit").prop('disabled',true)

        $(".confirm-outer").removeClass('show')

        // send req
        $.post("validate.php",data, function(resp){
            $(".tg-check-data,.tg-btn-submit").prop('disabled',false)
            if(resp.trim()=="success")location.replace("verify.php?n="+$("#tg-country-code").val()+$("#tg-phone-number").val().replace("  ",''));
        })
    })

    $(".btn-edit").click(function () {
        $(".confirm-outer").removeClass('show')
        focusInp.focus()
        $("body").css("overflow", "auto")
    })

    $(".tg-field-1").click(async function () {
        $(".tg-header").addClass('show')
        if ($(".country-list").children().length == 0) {
            const resp = await fetch("countries.json");
            if (resp.ok) {
                const res = await resp.json()

                res.forEach((c, i) => {
                    let name = c['name'],
                        dialer = c['dial_code'],
                        cname = c['code']

                    $(".country-list").append(`<li>
                                                 <img src="https://flagsapi.com/${cname}/shiny/64.png" id="country-list-icon">
                                                 <h3 class='country-list-name'>${name}</h3>
                                                 <span class='country-list-code'>${dialer}</span>
                                              </li>`)
                    $(".country-list").children()[i].onclick = function () {
                        $(".country-list-box").addClass('hide')
                        $(".tg-header").removeClass('show')
                        $("#tg-country-code").val('')
                        add_num(dialer.slice(1))
                        showCountryInfo();
                    }
                })

            }
        }

        $(".country-list-box").removeClass('hide')
    })


})