import React, {Component} from 'react';
import Head from 'next/head';
import Link from 'next/link';
import Layout, {siteName, siteTitle} from '../components/layout';
import API from '../libs/axios';
import {ImagesUrl} from '../libs/urls';
import {Container, Alert, Card, Row, Col, Spinner, Button, Form} from 'react-bootstrap';
import Slideshow from '../components/slideshow';
import Loader from 'react-loader';
import Blog from '../components/posts';
import {FaExclamationTriangle, FaCartPlus} from 'react-icons/fa';

var options = {lines: 13,length: 20,width: 10,radius: 30,scale: 0.35,corners: 1,color: '#fff',opacity: 0.25,rotate: 0,direction: 1,speed: 1,trail: 60,fps: 20,zIndex: 2e9,top: '50%',left: '50%',shadow: false,hwaccel: false,position: 'absolute'};

class Index extends Component{
  constructor(props) {
    super(props)
    this.state = {
        Slideshow: [],
        Posts: [],
        landing_intro: '',
        landing_img: '',
        url: ImagesUrl(),
        loading: true
    }
  
}
    componentDidMount() {
      API.GetSlideshow().then(res => {
          this.setState({
              Slideshow: res.data
          })
      })
      API.GetSetting().then(res=>{
        this.setState({
            landing_intro: res.data[0].landing_intro,
            landing_img: res.data[0].landing_img,
          })
      })

      API.GetBlog().then(res => {
        setTimeout(() => this.setState({
            Posts: res.data,
            loading: false
        }), 100);
      })
  } 
  render(){
        
    return(
      <Layout home>
      <Head>
        <title>Home - {siteTitle}</title>
      </Head>

      <main>
        <Slideshow data={this.state.Slideshow} data-aos="fade-down" /> 
        
        <Container>
       

        <Row>
          <Col md="12">
          
          { this.state.loading ?
          <Loader options={options} className="spinner" />
          :
          <>

          <section className="my-4">
            <Row>
              <Col lg={7}>
                <h1 className="display-4 fw-bold lh-1">Selamat Datang di <strong>{this.props.setting.company}</strong></h1>
                <p className="lead" data-aos="fade-down" data-aos-delay="30">{this.state.landing_intro}</p>
                <div className="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                  <Link href="https://bl.id/kumpulink_itshoppwt" passHref><a type="button" className="btn btn-success btn-lg px-4 me-md-2 fw-bold" data-aos="fade-left" data-aos-delay="50"><FaCartPlus/> Beli Sekarang</a></Link>
                </div>
              </Col>
              <Col lg={4} className="offset-lg-1 p-0 position-relative overflow-hidden shadow-lg">
                <div className="position-lg-absolute top-0 left-0 overflow-hidden">
                  <img className="d-block rounded-lg-3" src={this.state.url+this.state.landing_img} alt="" width="620"/>
                </div>
              </Col>
            </Row>
          </section>

            <section id="blog" className="blog-section">
              <h1 className="mb-3 h2" data-aos="fade-down" data-aos-delay="70">Posting Blog Terbaru</h1>
            <Blog data={this.state.Posts} />
            </section>
            </>
          }
          </Col>
        </Row>
        
        </Container>
      </main>
      </Layout>
    );
  }
}

export default Index;