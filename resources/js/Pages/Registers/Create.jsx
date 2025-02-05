import React, { useState } from 'react';
import { router } from '@inertiajs/react';

export default function Create({ majors, departments }) {
    // สถานะเพื่อจัดการประเภทฟอร์ม (student หรือ teacher)
    const [formType, setFormType] = useState('student');

    // สถานะเพื่อจัดการข้อมูลในฟอร์ม
    const [formData, setFormData] = useState({
        student_id: '',
        name: '',
        age: '',
        major: '',
        department: ''
    });

    // สถานะเพื่อจัดการการแจ้งเตือน
    const [notification, setNotification] = useState('');

    // ฟังก์ชันจัดการการเปลี่ยนแปลงข้อมูลในฟอร์ม
    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value
        });
    };

    // ฟังก์ชันจัดการการส่งฟอร์ม
    const handleSubmit = (e) => {
        e.preventDefault();
        let url = '/registers';
        if (formType === 'teacher') {
            url = '/teachers';
        }
        router.post(url, formData, {
            onSuccess: () => setNotification('Create Success'),
            onError: () => setNotification('Create Failed')
        });
    };

    // ฟังก์ชันจัดการการกลับไปยังหน้ารายการ
    const handleBack = () => {
        router.get('/registers/');
    };

    return (
        <div>
            {/* ปุ่มกลับไปยังหน้ารายการ */}
            <div className="flex justify-end">
                <button onClick={handleBack} className="px-4 py-2 bg-white-500 text-gray">Back</button>
            </div>
            <div className="p-16">
                <h1 className="text-3xl font-bold mb-8 text-center">Add New {formType.charAt(0).toUpperCase() + formType.slice(1)}</h1>
                {/* แสดงการแจ้งเตือน */}
                {notification && (
                    <div className={`mb-4 text-center ${notification === 'Create Success' ? 'text-green-500' : 'text-red-500'}`}>
                        {notification}
                    </div>
                )}
                <div className="flex justify-center mb-8">
                    {/* ปุ่มสำหรับเปลี่ยนประเภทฟอร์ม */}
                    <button
                        onClick={() => setFormType('student')}
                        className={`px-4 py-2 rounded ${formType === 'student' ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Student
                    </button>
                    <button
                        onClick={() => setFormType('teacher')}
                        className={`px-4 py-2 rounded ${formType === 'teacher' ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Teacher
                    </button>
                </div>
                {/* ฟอร์มสำหรับกรอกข้อมูล */}
                <form onSubmit={handleSubmit} className="max-w-md mx-auto bg-white p-8 rounded shadow">
                    {formType === 'student' && (
                        <>
                            <div className="mb-4">
                                <label className="block text-gray-700">Student ID</label>
                                <input
                                    type="text"
                                    name="student_id"
                                    value={formData.student_id}
                                    onChange={handleChange}
                                    className="w-full px-3 py-2 border rounded"
                                    required
                                />
                            </div>
                            <div className="mb-4">
                                <label className="block text-gray-700">Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    value={formData.name}
                                    onChange={handleChange}
                                    className="w-full px-3 py-2 border rounded"
                                    required
                                />
                            </div>
                            <div className="mb-4">
                                <label className="block text-gray-700">Age</label>
                                <input
                                    type="text"
                                    name="age"
                                    value={formData.age}
                                    onChange={handleChange}
                                    className="w-full px-3 py-2 border rounded"
                                    required
                                />
                            </div>
                            <div className="mb-4">
                                <label className="block text-gray-700">Major</label>
                                <select
                                    name="major"
                                    value={formData.major}
                                    onChange={handleChange}
                                    className="w-full px-3 py-2 border rounded"
                                    required
                                >
                                    <option value="">Select Major</option>
                                    {majors.map((major, index) => (
                                        <option key={index} value={major}>{major}</option>
                                    ))}
                                </select>
                            </div>
                        </>
                    )}

                    {formType === 'teacher' && (
                        <>
                            <div className="mb-4">
                                <label className="block text-gray-700">Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    value={formData.name}
                                    onChange={handleChange}
                                    className="w-full px-3 py-2 border rounded"
                                    required
                                />
                            </div>
                            <div className="mb-4">
                                <label className="block text-gray-700">Department</label>
                                <select
                                    name="department"
                                    value={formData.department}
                                    onChange={handleChange}
                                    className="w-full px-3 py-2 border rounded"
                                    required
                                >
                                    <option value="">Select Department</option>
                                    {departments.map((department, index) => (
                                        <option key={index} value={department}>{department}</option>
                                    ))}
                                </select>
                            </div>
                        </>
                    )}
                    <button type="submit" className="w-full bg-blue-500 text-white py-2 rounded">Add {formType.charAt(0).toUpperCase() + formType.slice(1)}</button>
                </form>
            </div>
        </div>
    );
}
