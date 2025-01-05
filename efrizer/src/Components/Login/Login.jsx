import React, { useState } from 'react';
import './Login.css';
import { useNavigate } from 'react-router-dom';
import { BsEnvelope, BsLock } from 'react-icons/bs';
import axios from 'axios';
import NewNavbar from '../NewNavbar/NewNavbar';
import Footer from '../Footer/Footer';

const Login = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    email: '',
    lozinka: ''  // Changed from password to match backend
  });
  const [error, setError] = useState('');

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
    setError('');
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    if (!formData.email || !formData.lozinka) {
      setError('Sva polja su obavezna');
      return;
    }
  
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/login', formData);
  
      if (response.data.success) {
        localStorage.setItem('salon', JSON.stringify(response.data.salon));
        navigate('/pricing'); // This will redirect to dashboard
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Greška pri prijavi');
    }
  };

  return (
    <>
      <NewNavbar />
      <div className="login-page">
        <div className="login-container">
          <h2>Prijava</h2>
          <form onSubmit={handleSubmit}>
            <div className="form-group">
              <div className="input-icon">
                <BsEnvelope className="icon" />
                <input
                  type="email"
                  placeholder="Email"
                  name="email"
                  value={formData.email}
                  onChange={handleChange}
                />
              </div>
            </div>

            <div className="form-group">
              <div className="input-icon">
                <BsLock className="icon" />
                <input
                  type="password"
                  placeholder="Lozinka"
                  name="lozinka"
                  value={formData.lozinka}
                  onChange={handleChange}
                />
              </div>
            </div>

            {error && <div className="error-message">{error}</div>}

            <button type="submit" className="login-button">
              Prijavi se
            </button>
          </form>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default Login;