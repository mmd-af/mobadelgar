import React from 'react';
import ReactDOM from 'react-dom/client';
import Navbar from "./Navbar.jsx";
import Boxes from "./Boxes.jsx";
import {CiBank} from "react-icons/ci";

function Home(props) {
    return (
        <div className="container">
            <Navbar/>
            <Boxes/>
        </div>
    );
}

export default Home;

if (document.getElementById('root')) {
    const Index = ReactDOM.createRoot(document.getElementById("root"));

    Index.render(
        <React.StrictMode>
            <Home/>
        </React.StrictMode>
    )
}
