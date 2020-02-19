BX24.init(() => {
    BX24.callMethod('app.info', {}, result => {
        let data = result.data();

        if (data.INSTALLED) {
            BX24.reloadWindow();
        } else {
            BX24.installFinish();
        }
    });
});