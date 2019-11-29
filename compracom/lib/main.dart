import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';


void main() async => runApp(MyApp());

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return new MaterialApp(
      title: 'Flutter Demo',
      theme: new ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: new Login(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  MyHomePage({Key key, this.title}) : super(key: key);
  final String title;
  @override
  _MyHomePageState createState() => new _MyHomePageState();
}



class _MyHomePageState extends State<MyHomePage> {
  Widget containerList = new Column();
  @override
  Widget build(BuildContext context){
    getData(context);
    return Scaffold(
      appBar: AppBar(
        title: Text("CompraCom"),
        centerTitle: true
      ),
      body: SingleChildScrollView(
        child: new Column(
          mainAxisAlignment: MainAxisAlignment.start,
          children: <Widget>[
            new Text(
              'Productos',
            ),
            containerList,
          ],
        ),
      ),
    );
  }

  Future<String> getData(context) async{
    var url = 'http://192.168.10.63/getsetlab/index.php';
    http.Response response = await http.post(url, body: {'pruebaPost': 'yeah'});
    var data = jsonDecode(response.body);
    getContainerList(context, data);
  }

  Future getContainerList(context, data) async{
    var texts = new List<Widget>();
    for(var value in data){
      var txt = Card(
        child: Center(
          child: Column(
            children: <Widget>[
              ListTile(
                leading: Image.memory(base64Decode(value["picture"])),
                title: Text(value["name"]+ value["price"]),
                trailing: RaisedButton(
                  onPressed: null,
                  child: Text(
                      'Añadir',
                      style: TextStyle(fontSize: 20)
                  ),
                ),
              ),
            ],
          ),
        ),
      );
      texts.add(txt);
    }
    setState(() {
      containerList = new Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Column(children: texts,),
        ],
      );
    });
  }


}

class Login extends StatelessWidget {
  String _user;
  String _pass;
  final _loginFormKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
          title: Text("CompraCom"),
          centerTitle: true
      ),
      body: SingleChildScrollView(
        child: Form(
          key: _loginFormKey,
          child: new Column(
            mainAxisAlignment: MainAxisAlignment.start,
            children: <Widget>[
              TextFormField(
                  onSaved: (value) => _user = value,
                  keyboardType: TextInputType.text,
                  decoration: InputDecoration(labelText: "Email Address")),
              TextFormField(
                  onSaved: (value) => _pass = value,
                  obscureText: true,
                  decoration: InputDecoration(labelText: "Password")),
              RaisedButton(child: Text("LOGIN"), onPressed: ()async{
                final form = _loginFormKey.currentState;
                form.save();tryLogin();
              }),
            ],
          ),
        ),
      ),
    );
  }

  Future<String> tryLogin() async{
    var url = 'http://192.168.10.63/getsetlab/index.php';
    http.Response response = await http.post(url, body: {'username': _user, 'password': _pass});

    print(jsonDecode(response.body));
  }
}