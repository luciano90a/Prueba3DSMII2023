import React, { useState, useEffect } from 'react';
import { FlatList, Text, View, TextInput, Button, Alert } from 'react-native';
import Userapi from './api/Userapi';

const List = () => {
  const [products, setProducts] = useState([]);
  const [productIdToDelete, setProductIdToDelete] = useState('');

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const response = await Userapi.get('/api/getproduct');
        setProducts(response.data);
      } catch (error) {
        console.error('Error al obtener la lista de productos:', error.message);
      }
    };

    fetchProducts();
  }, []);

  const handleDelete = async () => {
    try {
      await Userapi.delete(`/api/deleteproduct/${productIdToDelete}`);
      setProductIdToDelete(''); // Limpiar el TextInput después de la eliminación
      // Actualiza la lista de productos después de eliminar uno
      const response = await Userapi.get('/api/getproduct');
      setProducts(response.data);
    } catch (error) {
      console.error('Error al eliminar el producto:', error.message);
      Alert.alert('Error', 'No se pudo eliminar el producto.');
    }
  };

  return (
    <View>
      <Text>Lista de Productos:</Text>
      <FlatList
        data={products}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => (
          <View>
            <Text>{item.name}</Text>
            <Text>{item.description}</Text>
            <Text>Precio: {item.price}</Text>
            {/* Agrega más campos según sea necesario */}
          </View>
        )}
      />

      <Text>Eliminar Producto por ID:</Text>
      <TextInput
        placeholder="ID del Producto"
        value={productIdToDelete}
        onChangeText={(text) => setProductIdToDelete(text)}
        keyboardType="numeric"
      />
      <Button title="Eliminar Producto" onPress={handleDelete} />
    </View>
  );
};

export default List;




