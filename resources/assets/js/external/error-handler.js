class ErrorHandler {
    static handle(code, context) {
        console.log(code);
        let message
        switch (code) {
            case 413:
                message = 'Too large upload'
                break;
            case 401:
                message = 'セッションの有効時間が切れました。作業を続けるにはもう一度ログインしてください。'
                window.location.href = '/login'
                break;
            case 100:
                message = 'Unsuccessful Upload'
                break;
            
        }

        context.$swal({
            title: "警告!",
            text: message,
            type: "warning",
            confirmButtonText: "OK"
        });
    }

    static checkMethod(){
        alert('WHY')
    }
}

export default  ErrorHandler;