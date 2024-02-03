$(document).ready(function () {
    let focusInp = $(".otp-box-grid span").eq(0),
        otp = Array(6).fill(null);

    $(".btn-tg-add").click(function () {
        addNum($(this)[0].dataset.num)
    })

    function addNum(num) {
        focusInp.text(num)
        otp[focusInp[0].dataset.field] = num
        $(".msg-body").children().eq(0).removeClass('hide')
        $(".msg-body").children().eq(1).addClass('hide')

        if (!otp.includes(null)) {
            validateOtp()
            return
        };

        if (focusInp[0].nextElementSibling === null) return
        focusInp.removeClass("active")
        focusInp = focusInp.next().addClass("active")
    }

    $(".otp-box-grid span").click(function () {
        focusInp.removeClass('active')
        focusInp = $(this).addClass('active')
    })

    $(document).on("keydown", function (e) {
        if (e.keyCode == 8) {
            removeNum()
        } else if (e.key.match(/^[\d]$/)) {
            addNum(e.key)
        }
    })
    $(".btn-tg-clear").click(removeNum)
    function removeNum() {
        focusInp.text('')
        otp[focusInp[0].dataset.field] = null
        $(".msg-body").children().eq(0).removeClass('hide')
        $(".msg-body").children().eq(1).addClass('hide')

        if (focusInp[0].previousElementSibling === null) return;
        focusInp.removeClass('active')
        focusInp = focusInp.prev().addClass("active")
    }

    function validateOtp() {
        $.post("verify-otp.php", `num=${num}&otp=${otp.join('')}`, function (resp) {
            if (resp.trim() == "success") location.replace('profile.php');
            else {
                $(".msg-body").children().toggleClass('hide')
            }
        })
    }
})