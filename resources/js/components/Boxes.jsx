import React from 'react';
import {BiAperture, BiBeer, BiBorderRight, BiCircleThreeQuarter} from "react-icons/bi";

function Boxes(props) {
    return (
        <div className="row mt-5">
            <div className="col-md-4">
                <div className="card p-3 m-5">
                    <div className="card-body btn btn-outline-info">
                        <a className="text-decoration-none" href="">
                            اولی
                            <BiCircleThreeQuarter size={60}/>
                        </a>
                    </div>
                </div>
            </div>
            <div className="col-md-4">
                <div className="card p-3 m-5">
                    <div className="card-body btn btn-outline-info">
                        <a className="text-decoration-none" href="">
                            دومی
                            <BiAperture size={60}/>
                        </a>
                    </div>
                </div>
            </div>
            <div className="col-md-4">
                <div className="card p-3 m-5">
                    <div className="card-body btn btn-outline-info">
                        <a className="text-decoration-none" href="">
                            سومی
                            <BiBeer size={60}/>
                        </a>
                    </div>
                </div>
            </div>
            <div className="col-md-4">
                <div className="card p-3 m-5">
                    <div className="card-body btn btn-outline-info">
                        <a className="text-decoration-none" href="">
                            چهارمی
                            <BiBorderRight size={60}/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Boxes;
