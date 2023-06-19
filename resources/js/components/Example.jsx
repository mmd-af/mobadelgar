import React from 'react';
import ReactDOM from 'react-dom/client';

function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">به حیدر تبدیل خوش آمدید</div>

                        <div className="card-body"><h1> اینجا ما همه چیز و تبدیل میکنیم به غیر از آدما</h1></div>
                    </div>
                </div>
                <div className="col-md-4">
                    <div className="card bg-secondary">
                        <div className="card-header">به حیدر تبدیل خوش آمدید</div>

                        <div className="card-body">اینجا ما همه چیز و تبدیل میکنیم به غیر از آدما</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('root')) {
    const Index = ReactDOM.createRoot(document.getElementById("root"));

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}
