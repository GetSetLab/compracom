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
      home: MyHomePage(title: 'CompraCom'),
    );
  }
}

class MyHomePage extends StatefulWidget {
  MyHomePage({Key key, this.title}) : super(key: key);
  final String title;
  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {

  String textData = "init";
  Widget containerList = new Column();

  @override
  Widget build(BuildContext context){
    getData();

    return Scaffold(
      appBar: AppBar(
        title: Text(textData),
        centerTitle: true
      ),
      body: new Center(
        child: new Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            new Text(
              'No ha cargado :(',
            ),
            new Text(
              textData,
              style: Theme.of(context).textTheme.display1,
            ),
            containerList,
          ],
        ),
      ),
    );
  }

  Future<String> getData() async{
    var url = 'http://192.168.10.63/server/bd.php';
    http.Response response = await http.get(url);
    var data = jsonDecode(response.body);
    getContainerList(context, data);
  }

  Future getContainerList(context, data) async{
    var texts = new List<Widget>();
    for(var value in data){
      var txt = new Text(
        value["col"]+ value["col2"],
        style: Theme.of(context).textTheme.display1,
      );
      texts.add(txt);
    }
    containerList =
      new Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            new Text(
              'Ha cargado',
            ),
            Column(children: texts,),
          ],
      );
  }
}




