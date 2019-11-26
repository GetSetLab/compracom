import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';


void main() async => runApp(MyApp());

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Demo',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: Home(),
    );
  }
}

class Home extends StatelessWidget {

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
    var url = 'http://192.168.10.63/server/bd.php';
    http.Response response = await http.get(url);
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
                leading: FlutterLogo(),
                title: Text(value["col"]+ value["col2"]),
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
    containerList =
      new Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Column(children: texts,),
          ],
      );
  }
}

class Product extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
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
              'DETALLES DEL PRODUCTO',
            ),
          ],
        ),
      ),
    );
  }
}


