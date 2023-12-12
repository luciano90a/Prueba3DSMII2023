import React, { useState, useEffect } from 'react';
import { FlatList, Text, View } from 'react-native';
import Userapi from './api/Userapi';

const List = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Función para obtener la lista de productos desde la API
    const fetchProducts = async () => {
      try {
        const response = await Userapi.get('/api/getproduct');
        setProducts(response.data);
      } catch (error) {
        console.error('Error al obtener la lista de productos:', error.message);
      }
    };

    // Llamar a la función para obtener productos cuando el componente se monta
    fetchProducts();
  }, []); // El segundo parámetro del useEffect asegura que la solicitud solo se realice una vez al montar el componente

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
    </View>
  );
};

export default List;



