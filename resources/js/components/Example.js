import axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Example extends Component {
    constructor(props){
        super(props);
        this.state = {
            colleges: []
        }
    }

    componentDidMount(){
        axios.get('api/colleges').then((response) => {
            this.setState(
                this.colleges = response.data
        )
            console.log(this.colleges)
        })
    }

    render() {
        return (
            <div className="container">
                <div className="row m-t-40 popup-gallery">

                    {this.colleges.map((college)=> {
                        
                    })}

                </div>
            </div>
        );
    }


}

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
