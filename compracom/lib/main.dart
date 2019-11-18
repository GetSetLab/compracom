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

  String textData = "ini";
  List<Widget> _contatos = new List.generate(_count, (int i) => new ContactRow());

  @override
  Widget build(BuildContext context){
    getData();
    return Scaffold(
      appBar: AppBar(
        title: Text("rafa"),
        centerTitle: true
      ),
      body: new Center(
        child: new Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            new Text(
              'You have pushed the button this many times:',
            ),
            new Text(
              textData,
              style: Theme.of(context).textTheme.display1,
            ),
          ],
        ),
      ),
    );
  }

  Future getData() async{
    var url = 'http://192.168.10.63/server/bd.php';
    http.Response response = await http.get(url);
    var data = jsonDecode(response.body);
    textData = data["col"];
  }
}




