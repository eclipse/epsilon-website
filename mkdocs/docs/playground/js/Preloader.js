class Preloader {

    visible = true;

    hide() {
        if (this.visible) {
            var self = this;
            setTimeout(function () {
                document.getElementById("preloader").style.display = "none";
                self.visible = false;
            }, 1000);
        }
    }
}

export { Preloader };