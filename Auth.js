class Auth {

    table = "";

    constructor(model) {
        this.model = model
    }

    login(){
        
        this.model.find()
    }

    query() {
         
    }
}


class User extends Auth {
    constructor() {
        super(drthtudr)
        this.table = "user"
    }


}

class Seller extends Auth {
    constructor() {
        this.table = "seller"
    }
}