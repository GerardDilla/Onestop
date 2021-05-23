'use strict';

const e = React.createElement;

class LikeButton extends React.Component {
constructor(){
    super();
    this.state = {
        data:[],
        search:''
    }
    this.searchBox = this.searchBox.bind(this);
    this.searchBox2 = this.searchBox2.bind(this);
}
searchBox2(){

}
searchBox(e){
    const {name,value} = e.target;
    this.setState({search:value});
    fetch("getDataTableData?search="+this.state.search).then(response => response.json()).then(data => { if(this.state.data!=data){ return this.setState({data:data})}});
}
componentDidMount(){
    fetch("getDataTableData").then(response => response.json()).then(data => this.setState({data:data}));
}
 render(){
     return (
         <>
         <div className="row" style={{marginBottom:'10px'}}>
            <div className="col-md-8" align="right"></div>
            <div className="col-md-4" align="right"><input type="text" onKeyUp={this.searchBox} name="search" className="form-control"/></div>
         </div>
         <table className="table table-striped table-dark mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                {this.state.data.map(item => { 
                    return (
                        <tr key={item.id}>
                            <td className="text-bold-500">{item.id}</td>
                            <td className="text-bold-500">{item.name}</td>
                            <td>{item.age}</td>
                            <td>{item.date}</td>
                        </tr>
                    )
                })}
                
            </tbody>
        </table>
        </>
     )
 }
}

const domContainer = document.querySelector('#root');
// ReactDOM.render(e(LikeButton), domContainer);