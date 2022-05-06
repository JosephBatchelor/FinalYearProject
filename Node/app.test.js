const request = require('supertest');
const bcrypt = require('bcrypt');
const app = require("./app.js");
const value = require("./values.js");
const Plaintext = "Testing";

    test("1). Route test", async() =>{
        const Signintemp = await request(app).get("/FinalYearProject/Signintemp").expect(200);
        const TruelayerRedirect = await request(app).get("/FinalYearProject/truelayer-redirect").expect(200);
        const Display = await request(app).get("/FinalYearProject/display").expect(200);
    })

    test("2).Database config value test", () =>{
        expect(value.Con.config.host).toEqual("localhost");
        expect(value.Con.config.database).toEqual("jb1828_loginsystem");
        expect(value.Con.config.user).toEqual("jb1828_root");
        expect(value.Con.config.password).toEqual("A1B2C3a1b2c3");
    })

    test("3). Database connection test", async() =>{
    value.con.connect(function (err) {
            if (err) throw err;
        }); 
    })

    test("4). Database query test", async() =>{
        value.con.connect(function (err) {
            var sql = "SELECT * FROM users;";
            value.con.query(sql,function(err, row){
                if (err) throw err;
                expect(row.length).toBeGreaterThan(0);
                });           
            }); 
        })

   test("5). Hash Function encryption test", () =>{
    const hash = bcrypt.hashSync(Plaintext, 10);
    expect(hash).not.toBe(Plaintext);
      })

    test("6). Hash Function decryption test", () =>{
    const hash = bcrypt.hashSync(Plaintext, 10);    
    bcrypt.compare(Plaintext , hash, function(err, result) {
            if (result == true) throw err;
    });
      })