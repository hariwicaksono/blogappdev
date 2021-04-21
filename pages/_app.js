import React, { Component } from "react";
import AOS from 'aos';
import 'aos/dist/aos.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../styles/global.css';
import '../styles/main.css';
import 'spin.js/spin.css';
import 'react-toastify/dist/ReactToastify.css';
import { ToastContainer } from 'react-toastify';
import API from '../libs/axios';


class MyApp extends Component {
  constructor(props){
    super(props)
    this.state = {
      Pengaturan: []
        }
    }

 

  componentDidMount = () => {
    AOS.init();
    API.GetSetting().then(res=>{
      this.setState({
          Pengaturan: res.data[0]
      })
    })
  }

  render() {
    const { Component, pageProps } = this.props;

    return (   
    <>
    <Component {...pageProps} setting={this.state.Pengaturan} />
    <ToastContainer />
    </>
    );
  }
}

export default MyApp;
