import React, { useState } from 'react';
import { router } from '@inertiajs/react';

export default function Index({ table, tableNo }) {
    const [selectedTable, setSelectedTable] = useState(tableNo || 1);
    const [searchQuery, setSearchQuery] = useState('');

    // กำหนดคอลัมน์สำหรับแต่ละตาราง
    const columns = {
        1: [
            { label: 'ID', key: 'id' },
            { label: 'Course Code', key: 'course_code' },
            { label: 'Course Name', key: 'course_name' },
            { label: 'Teacher ID', key: 'teacher_id' },
        ],
        2: [
            { label: 'ID', key: 'id' },
            { label: 'Student ID', key: 'student_id' },
            { label: 'Name', key: 'name' },
            { label: 'Age', key: 'age' },
            { label: 'Major', key: 'major' },
        ],
        3: [
            { label: 'ID', key: 'id' },
            { label: 'Teacher Name', key: 'name' },
            { label: 'Department', key: 'department' },
        ],
        4: [
            { label: 'ID', key: 'id' },
            { label: 'Student ID', key: 'student_id' },
            { label: 'Course ID', key: 'course_id' },
            { label: 'Semester', key: 'semester' },
        ]
    };

    // จัดการการเปลี่ยนหน้าในการแบ่งหน้า
    const handlePageChange = (url, selectedTable) => {
        router.get(url, { selectedTable, search: searchQuery });
    };

    // จัดการการเปลี่ยนตาราง
    const handleTableChange = (newTable) => {
        setSelectedTable(newTable);
        handlePageChange('/registers', newTable);
    };

    // จัดการการค้นหา
    const handleSearch = (e) => {
        e.preventDefault();
        handlePageChange('/registers', selectedTable);
    };

    // จัดการการไปยังหน้า create
    const handleCreate = () => {
        router.get('/registers/create');
    };

    // จัดการการไปยังหน้า edit
    const handleEditMenu = () => {
        router.get('/registers/edit');
    };

    return (
        <>
            <div className="p-16">
                <div className="flex justify-between items-center mb-8">
                    <h1 className="text-3xl font-bold">ตารางแสดงผลข้อมูลทะเบียนนักศึกษา</h1>
                    <div className="flex space-x-4">
                        {/* ปุ่มสำหรับไปยังหน้า create */}
                        <button onClick={handleCreate} className="px-4 py-2 bg-green-500 text-gray rounded">Add New</button>
                        {/* ปุ่มสำหรับไปยังหน้า edit */}
                        <button onClick={handleEditMenu} className="px-4 py-2 bg-yellow-500 text-gray rounded">Edit Menu</button>
                    </div>
                </div>
                <div className="flex justify-end items-center mb-8 space-x-4">
                    {/* ฟอร์มค้นหา */}
                    <form onSubmit={handleSearch} className="flex space-x-2">
                        <input
                            type="text"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            placeholder="Search..."
                            className="px-4 py-2 border rounded"
                        />
                        <button type="submit" className="px-4 py-2 bg-blue-500 text-white rounded">Search</button>
                    </form>
                </div>
                <div className="flex justify-end items-center mb-8 space-x-4">
                    {/* ปุ่มสำหรับเปลี่ยนตาราง */}
                    <button
                        onClick={() => handleTableChange(1)}
                        className={`px-4 py-2 rounded ${selectedTable === 1 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Course
                    </button>
                    <button
                        onClick={() => handleTableChange(2)}
                        className={`px-4 py-2 rounded ${selectedTable === 2 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Student
                    </button>
                    <button
                        onClick={() => handleTableChange(3)}
                        className={`px-4 py-2 rounded ${selectedTable === 3 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Teacher
                    </button>
                    <button
                        onClick={() => handleTableChange(4)}
                        className={`px-4 py-2 rounded ${selectedTable === 4 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Register
                    </button>
                </div>
                {/* ตารางสำหรับแสดงข้อมูล */}
                <table className="min-w-full bg-white border border-gray-300">
                    <thead className="bg-blue-500 text-white">
                        <tr>
                            {columns[selectedTable].map((column) => (
                                <th key={column.key} className="py-2 px-4 border-b border-gray-400">{column.label}</th>
                            ))}
                        </tr>
                    </thead>
                    <tbody>
                        {table.data.map(item => (
                            <tr key={item.id} className="even:bg-gray-100">
                                {columns[selectedTable].map((column) => (
                                    <td key={column.key} className="py-2 px-4 border-b border-gray-400 text-center">
                                        {item[column.key]}
                                    </td>
                                ))}
                            </tr>
                        ))}
                    </tbody>
                </table>
                {/* การควบคุมการแบ่งหน้า */}
                <div className="mt-8 flex justify-center items-center space-x-4">
                    <button
                        onClick={() => handlePageChange(`${table.prev_page_url}`, selectedTable)}
                        disabled={!table.prev_page_url}
                        className="px-4 py-2 bg-blue-500 text-white rounded disabled:opacity-50"
                    >
                        Previous
                    </button>
                    <span className="text-lg">Page {table.current_page} of {table.last_page}</span>
                    <button
                        onClick={() => handlePageChange(`${table.next_page_url}`, selectedTable)}
                        disabled={!table.next_page_url}
                        className="px-4 py-2 bg-blue-500 text-white rounded disabled:opacity-50"
                    >
                        Next
                    </button>
                </div>
            </div>
        </>
    );
}
