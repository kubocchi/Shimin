class common {
    static donwload(attachment) {
        axios({
            url: `/api/download/${attachment.path}`,
            method: 'GET',
            responseType: 'blob', // important
        }).then((response) => {
            if (!window.navigator.msSaveOrOpenBlob) {
                // BLOB NAVIGATOR
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', attachment.name);
                document.body.appendChild(link);
                link.click();
            } else {
                // BLOB FOR EXPLORER 11
                const url = window.navigator.msSaveOrOpenBlob(new Blob([response.data]), attachment.name);
            }
        });
    }
}

export default common;